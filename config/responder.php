<?php
/*
 * Copyright (c) 2021. Farshid Rezaei
 */


use FarshidRezaei\VandarResponder\CustomExceptions\CustomAuthenticationException;
use FarshidRezaei\VandarResponder\CustomExceptions\CustomDefaultException;
use FarshidRezaei\VandarResponder\CustomExceptions\CustomMethodNotAllowed;
use FarshidRezaei\VandarResponder\CustomExceptions\CustomNotFoundHttpException;
use FarshidRezaei\VandarResponder\CustomExceptions\CustomThrottleRequestsException;
use FarshidRezaei\VandarResponder\CustomExceptions\CustomUnauthorizedException;
use FarshidRezaei\VandarResponder\CustomExceptions\CustomValidationException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Exceptions\ThrottleRequestsException;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
use Symfony\Component\Routing\Exception\MethodNotAllowedException;

return [
    'errors' => [
        'UNKNOWN_ERROR' => 'unknown_error',
        'INTERNAL_ERROR' => 'internal_error',
        'INVALID_ARGUMENT_ERROR' => 'invalid_argument_error',
        'VALIDATION_ERROR' => 'validation_error',
        'NOT_FOUND_ERROR' => 'not_found_error',
        'UNAUTHORIZED_ERROR' => 'unauthorized_error',
        'UNAUTHENTICATED_ERROR' => 'unauthenticated_error',
        'TOO_MANY_REQUESTS_ERROR' => 'too_many_requests_error',
        'METHOD_NOT_ALLOWED' => 'method_not_allowed',
        'GENERAL_ERROR' => 'general_error',
        'FORBIDDEN_ERROR' => 'forbidden_error',
        'GET_TOKEN_ERROR' => 'get_token_error',
        'PAYMENT_VERIFY_FORBIDDEN_ERROR' => 'payment_verify_forbidden_error',
        'PAYMENT_FORBIDDEN_ERROR' => 'payment_forbidden_error',
        'EXTERNAL_SERVICE_ERROR'=>'internal_error'
    ],
    'customExceptions' => [
        RuntimeException::class => CustomDefaultException::class,
        Exception::class => CustomDefaultException::class,
        ValidationException::class => CustomValidationException::class,
        NotFoundHttpException::class => CustomNotFoundHttpException::class,
        MethodNotAllowedException::class => CustomMethodNotAllowed::class,
        ModelNotFoundException::class => CustomNotFoundHttpException::class,
        AuthenticationException::class => CustomAuthenticationException::class,
        AuthorizationException::class => CustomUnauthorizedException::class,
        UnauthorizedHttpException::class => CustomUnauthorizedException::class,
        ThrottleRequestsException::class => CustomThrottleRequestsException::class
    ]
];
