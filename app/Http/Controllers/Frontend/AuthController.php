<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\IssueTokenTrait;
use App\Http\Requests\LoginRequest;

class AuthController extends FrontendController
{
    use IssueTokenTrait;

    public function login(LoginRequest $request)
    {
        return $this->issueAccessToken($request);
    }

    public function logout()
    {
        return $this->revokeAccessToken();
    }

    public function isLogged()
    {
        return $this->responseSuccess(auth()->check());
    }
}