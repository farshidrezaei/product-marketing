<?php

namespace App\Http\Controllers\API\V1\Auth;

use App\Exceptions\Auth\BadCredentialsException;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Throwable;

class LoginAction extends Controller
{
    /**
     * @throws Throwable
     */
    public function __invoke(Request $request)
    {
        throw_if(
            !Auth::attempt(['email' => $request->input('email'), 'password' => $request->input('password')]),
            BadCredentialsException::class
        );

        return response()
            ->success(
                __('api.auth.login'),
                [
                    'user' => UserResource::make($user = Auth::user()),
                    'token' => $user->createToken('productMarketing')->plainTextToken
                ]
            );
    }

}