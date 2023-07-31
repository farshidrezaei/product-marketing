<?php

namespace App\Http\Controllers\API\V1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Auth\RegisterRequest;
use App\Http\Resources\UserResource;
use App\Models\User;

class RegisterAction extends Controller
{
    public function __invoke(RegisterRequest $request)
    {
        $user = User::create($request->validated());

        return response()
            ->success(
                __('api.auth.register'),
                [
                    'user' => UserResource::make($user),
                    'token' => $user->createToken('productMarketing')->plainTextToken
                ]
            );
    }

}