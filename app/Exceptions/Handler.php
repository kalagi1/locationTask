<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\TooManyRequestsHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->renderable(function (Exception $e,$request) {
            if ($request->is('api/*')) {
                if($e instanceof NotFoundHttpException){
                    return $this->handleNotFoundException();
                }else if($e instanceof ValidationException){
                    return $this->handleValidationException($e);
                }
            }
        });
    }

    protected function handleValidationException(ValidationException $exception)
    {
        $errors = $exception->validator->errors()->getMessages();

        return new JsonResponse([
            'errors' => array_merge(...array_values($errors)),
        ], 422);
    }

    protected function handleNotFoundException()
    {
        return new JsonResponse([
            'errors' => ["Data is not found"],
        ], 404);
    }

}
