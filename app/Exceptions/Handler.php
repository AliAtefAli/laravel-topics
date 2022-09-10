<?php

namespace App\Exceptions;

use App\Traits\HasResponse;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Support\Arr;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    use HasResponse;
    /**
     * A list of the exception types that are not reported.
     *
     * @var string[]
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var string[]
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    public function render($request, Throwable $exception)
    {
        if ($request->is('api/*')) {
            if ($exception instanceof ModelNotFoundException) {
                return $this->failMsg(trans('response.404'));
            } elseif ($exception instanceof NotFoundHttpException) {
                return $this->failMsg(trans('response.404_not_found'));
            } elseif ($exception instanceof MethodNotAllowedHttpException) {
                return $this->failMsg(trans('response.method_not_allowed'), '419');
            }
        }

        return parent::render($request, $exception);
    }

    protected function unauthenticated($request, \Illuminate\Auth\AuthenticationException $exception)
    {
        if ($request->is('api/*')){
            return $this->failMsg(trans('response.unauthenticated'));
        }

        $guard = Arr::get($exception->guards(),0);

        switch ($guard) {
            default:
                $login = 'login';
                break;
        }
        return redirect()->guest(route($login));
    }
}
