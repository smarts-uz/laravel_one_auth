<?php


namespace Teampro\OneAuth;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;


class OneAuthService
{
    private static $code;

    public static function getAccessToken()
    {
        $response = Http::asForm()->post(env("ONE_ID_API_URL"), [
            'grant_type' => 'one_authorization_code',
            'client_id' => env('ONE_ID_CLIENT_ID'),
            'client_secret' => env('ONE_ID_CLIENT_SECRET'),
            'code' => self::$code,
            'redirect_uri' => env('ONE_ID_REDIRECT_URI')
        ]);

        return json_decode($response)->access_token;
    }

    public static function getOneAuthData()
    {
        $response = Http::asForm()->post(env("ONE_ID_API_URL"), [
            'grant_type' => 'one_access_token_identify',
            'client_id' => env('ONE_ID_CLIENT_ID'),
            'client_secret' => env('ONE_ID_CLIENT_SECRET'),
            'access_token' => self::getAccessToken()
        ]);

        return json_decode($response);
    }

    public static function makeParams()
    {
        $response = self::getOneAuthData();


        $datas = [
            'username' => $response->user_id,
            'firstname' => $response->first_name,
            'lastname' => $response->sur_name,
            'midname' => $response->mid_name,
            'pinfl' => $response->pin,
            'inn' => $response->tin,
            'passport' => $response->pport_no,
            'passport_expire_date' => Carbon::createFromFormat('Y-d-m', $response->pport_expr_date)->format('Y-m-d'),
            'phone' => $response->mob_phone_no,
            'address' => $response->per_adr ?? null,
            'email' => $response->email,
            'name' => $response->user_id,
            'password' => Hash::make(uniqid()),
        ];
        return $datas;
    }

    public static  function authorizeUser($token)
    {
        self::$code = $token;
        $params = self::makeParams();
        $user = User::query()->where('pinfl',$params['pinfl'] )->where('email', $params['email'])->first();

        if (!$user){
            $user = new User();
            $user->name = $params['name'];
            $user->username = $params['username'];
            $user->firstname = $params['firstname'];
            $user->lastname = $params['lastname'];
            $user->midname = $params['midname'];
            $user->pinfl = $params['pinfl'];
            $user->inn = $params['inn'];
            $user->passport = $params['passport'];
            $user->passport_expire_date = $params['passport_expire_date'];
            $user->phone = $params['phone'];
            $user->address = $params['address'];
            $user->email = $params['email'];
            $user->password = $params['password'];
            $user->save();
        }
        Auth::login($user);
    }
}
