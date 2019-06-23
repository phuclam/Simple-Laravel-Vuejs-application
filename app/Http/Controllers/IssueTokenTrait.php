<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

trait IssueTokenTrait
{
    /**
     * Grant Access Token
     *
     * @param $request
     * @return mixed
     */
    public function issueAccessToken($request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();
            $expires = 24 * 60 * 60;
            $tokenObj = $user->createToken('Token');
            $tokenObj->token->update(['expires_at' => Carbon::now()->addSeconds($expires)]);

            return $this->responseSuccess([
                'access_token' => $tokenObj->accessToken,
                'expires_in' => $expires,
                'token_type' => 'Bearer',
            ]);
        }

        return $this->responseError('Authentication error', 403);
    }

    /**
     * Revoke Token
     *
     * @return mixed
     */
    public function revokeAccessToken()
    {
        $accessToken = Auth::user()->token();

        DB::table('oauth_refresh_tokens')
            ->where('access_token_id', $accessToken->id)
            ->update(['revoked' => true]);

        $accessToken->revoke();

        return $this->responseSuccess([
            'message' => 'You are logged out'
        ]);

    }
}