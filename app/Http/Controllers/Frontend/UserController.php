<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends FrontendController
{
    public function profile()
    {
        dd(auth()->user()->email);
    }

    public function register(RegisterRequest $request)
    {
        $user = new User();
        $user->name = '';
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password'));

        if ($user->save()) {
            $auth = new AuthController();
            $loginRequest = new Request();
            $loginRequest->replace(['email' => $user->email, 'password' => $request->password]);
            return $auth->issueAccessToken($loginRequest);
        }

        return $this->responseError('Something went wrong. Please try again.');
    }
}