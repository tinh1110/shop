<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    protected $addHttpCookie = true;

    protected $except = [
        'auth/facebook/callback',
        'auth/google/callback',
    ];
//    protected $except = [
//        //
//    ];
}