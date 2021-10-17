<?php

namespace App\Exceptions;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\Eloquent\RelationNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Exceptions\ThrottleRequestsException;
use Illuminate\Http\Request;
use Illuminate\Routing\Exceptions\InvalidSignatureException;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
use Symfony\Component\Routing\Exception\RouteNotFoundException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param Throwable $e
     * @return void
     *
     * @throws Throwable
     */
    public function report(Throwable $e)
    {
        parent::report($e);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param Request $request
     * @param Throwable $e
     * @return Response
     *
     * @throws Throwable
     */
    public function render($request, Throwable $e): Response
    {
        if ($e instanceof ModelNotFoundException) {
            return response()->json([
                'message' => trans('message.not_found'),
                'error' => trans('message.entry_not_found', ['model' => str_replace('App\\Models\\', '', $e->getModel())])
            ], 404);
        }

        if ($e instanceof RelationNotFoundException) {
            return response()->json([
                'message' => trans('message.not_found'),
                'error' => trans('message.relation_not_found')
            ], 404);
        }

        if ($e instanceof AccessDeniedHttpException) {
            return response()->json([
                'message' => trans('message.no_permission'),
                'error' => trans('auth.access_denied')
            ], 403);
        }

        if ($e instanceof InvalidSignatureException) {
            return response()->json([
                'error' => trans('message.invalid_signature')
            ], 403);
        }

        if ($e instanceof ThrottleRequestsException) {
            return response()->json([
                'error' => trans('message.too_many_requests')
            ], 429);
        }

        if ($e->getMessage() === 'CSRF token mismatch.') {
            return response()->json([
                'error' => trans('message.invalid_csrf_token')
            ], 419);
        }

        if ($e instanceof UnauthorizedHttpException) {

            if ($e->getMessage() === 'User not found') {
                return response()->json([
                    'message' => trans('message.not_found'),
                    'error' => trans('auth.user_not_found')
                ], 404);
            }

            //To log untreated unauthorized exceptions
            Log::error('UNAUTHORIZED_EXCEPTION:' . $e->getMessage());
            return response()->json([
                'message' => trans('auth.unauthenticated'),
                'error' => trans('message.contact_support')
            ], 401);
        }

        if ($e instanceof MethodNotAllowedHttpException) {
            return response()->json([
                'error' => $e->getMessage()
            ], 405);
        }

        if ($e instanceof NotFoundHttpException) {
            return response()->json([
                'message' => trans('message.not_found'),
            ], 404);
        }

        if ($e instanceof RouteNotFoundException) {
            return response()->json([
                'message' => trans('message.not_found'),
                'error' => trans('message.route_not_found')
            ], 404);
        }

        return parent::render($request, $e);
    }
}
