<?php

namespace App\Exceptions;

use App\Http\Responses\JsonApiValidationErrorResponse;
use App\Traits\ApiResponser;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    use ApiResponser;

    protected $levels = [
        //
    ];

    protected $dontReport = [
        AuthorizationException::class,
        HttpException::class,
        ModelNotFoundException::class,
        ValidationException::class,
    ];

    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    public function render($request, Throwable $exception)
    {
        if ($exception instanceof HttpException) {
            $code = $exception->getStatusCode();
            $message = Response::$statusTexts[$code];
            return $this->errorResponse($message,$code);
        }

        if ($exception instanceof ModelNotFoundException) {
            $model = trim(strtolower(class_basename($exception->getModel())));
            return $this->errorResponse("Does not exist any instanceof {$model} with the given id",
                Response::HTTP_NOT_FOUND);
        }

        if ($exception instanceof AuthorizationException) {
            return $this->errorResponse($exception->getMessage(),
                Response::HTTP_FORBIDDEN);
        }

        if ($exception instanceof AuthenticationException) {
            return $this->errorResponse($exception->getMessage(),
                Response::HTTP_UNAUTHORIZED);
        }

        if(env('APP_DEBUG',false)){
            return parent::render($request, $exception);
        }

        return $this->errorResponse('Enexpected error. Try later',Response::HTTP_INTERNAL_SERVER_ERROR);

    }

    public function register()
    {
//        $this->reportable(function (Throwable $e) {
//            //
//        });
    }

    protected function invalidJson($request, ValidationException $exception): JsonApiValidationErrorResponse|JsonResponse
    {
        if (! $request->routeIs('api/login')) {
            return new JsonApiValidationErrorResponse($exception,422);
        }
        return parent::invalidJson($request, $exception);
    }
}
