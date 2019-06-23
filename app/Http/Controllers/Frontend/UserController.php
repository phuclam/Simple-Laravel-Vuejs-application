<?php

namespace App\Http\Controllers\Frontend;


class UserController extends FrontendController
{
    public function profile()
    {
        dd(auth()->user()->email);
    }
}