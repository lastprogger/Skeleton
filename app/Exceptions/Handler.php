<?php

namespace App\Exceptions;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;
use JMS\Serializer\ArrayTransformerInterface;
use JMS\Serializer\SerializationContext;
use JMS\Serializer\SerializerInterface;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Log;
use Route;

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
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param  \Exception $exception
     *
     * @return void
     * @throws \Exception
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Exception               $exception
     *
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        if ($request->wantsJson()) {
            Log::error($exception);

            $apiVersion = $request->route()->parameter('version', config('app.api_version'));

            $route = Route::current();
            if (null === $route) {
                return parent::render($request, $exception);
            }

            $action           = $route->action;
            $doNotSetHttpCode = true;
            if (isset($action[Controller::ACTION_GROUP_NAME_KEY])) {
                switch ($action[Controller::ACTION_GROUP_NAME_KEY]) {
                    case Controller::ACTION_GROUP_NAME_INTERNAL_API:
                        $doNotSetHttpCode = false;
                        break;
                    default:
                        break;
                }
            }

            /**
             * @var SerializerInterface|ArrayTransformerInterface $serializer
             */
            $serializer = app(SerializerInterface::class);
            $context    = SerializationContext::create()
                                              ->setGroups(['api'])
                                              ->setVersion($apiVersion)
                                              ->setSerializeNull(false)
                                              ->enableMaxDepthChecks();

            switch (true) {
                case ($exception instanceof Api\ApiException):
                    $renderException = $exception;
                    break;

                case ($exception instanceof HttpException):
                    $errorText       = $exception->getMessage() === '' ? null : $exception->getMessage();
                    $renderException = new Api\ApiException($exception->getStatusCode(), $errorText);
                    break;

                case ($exception instanceof ValidationException):
                    $errorMessageBag = $exception->validator->errors();
                    $errorKeys       = $errorMessageBag->keys();
                    $formattedErrors = [];

                    foreach ($errorKeys as $key) {
                        $formattedErrors[$key] = $errorMessageBag->first($key);
                    }

                    $errorText = $exception->getMessage() === '' ? null : $exception->getMessage();

                    $renderException = new Api\ApiException($exception->status, $errorText, $formattedErrors);
                    break;

                default:
                    $renderException = new Api\ApiException(
                        Response::HTTP_INTERNAL_SERVER_ERROR,
                        'Internal server error'
                    );
                    break;
            }

            return response()->json(
                $serializer->toArray($renderException, $context),
                $doNotSetHttpCode ? Response::HTTP_OK : $renderException->getCode()
            );
        }

        return parent::render($request, $exception);
    }
}
