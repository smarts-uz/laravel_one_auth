<?php


return [
    'name' => 'OneAuth',

    'CLIENT_ID' => env('ONE_ID_CLIENT_ID', ''),
    'API_URL' => env('ONE_ID_API_URL', ''),
    'CLIENT_SECRET' => env('ONE_ID_CLIENT_SECRET', ''),
    'SCOPE' => env('ONE_ID_SCOPE', ''),
    "REDIRECT_URI" => env('ONE_ID_REDIRECT_URI', ''),

];
