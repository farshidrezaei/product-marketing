<?php

namespace App\Exceptions\Auth;

use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;


class BadCredentialsException extends Exception
{
    /**
     * Handles output message.
     *
     * @return JsonResponse
     */
    public function render(): JsonResponse
    {
        return response()->failure(
            errorCode: Response::HTTP_FORBIDDEN,
            stringErrorCode: config('responder.errors.FORBIDDEN_ERROR'),
            message: __('responder::exceptions.badCredential')
        );
    }
}
