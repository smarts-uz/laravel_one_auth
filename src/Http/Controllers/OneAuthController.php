<?php

namespace Teampro\OneAuth\Http\Controllers;

use App\Http\Controllers\Controller;
use Teampro\OneAuth\OneAuthService;
use Illuminate\Http\Request;

class OneAuthController extends Controller
{
    //

    public function auth(){
        $url = env("ONE_ID_API_URL")."?response_type=one_code&client_id=".env('ONE_ID_CLIENT_ID','')
            .'&redirect_uri='.env('ONE_ID_REDIRECT_URI').'&scope='.env('ONE_ID_SCOPE', '')."&state=testState";

        return redirect($url);
    }

    public function login(Request $request){
        OneAuthService::authorizeUser($request->code);

        return redirect("/");

    }

}
