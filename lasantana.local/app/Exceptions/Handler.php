<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        \Illuminate\Auth\AuthenticationException::class,
        \Illuminate\Auth\Access\AuthorizationException::class,
        \Symfony\Component\HttpKernel\Exception\HttpException::class,
        \Illuminate\Database\Eloquent\ModelNotFoundException::class,
        \Illuminate\Session\TokenMismatchException::class,
        \Illuminate\Validation\ValidationException::class,
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        $exception = $this->prepareException($exception);
        if ($this->isHttpException($exception)) {
            $statusCode = $exception->getStatusCode();
            switch ($statusCode) {
                case '404' :
                    \Log::alert('Страница не найдена - ' . $request->url());
                    $out =  $this->preperViewError();
                    $out['title'] = 'Страница не найдена';
                    
                    return response()->view( 'errors.404',  $out );
                    
                    break;
                case '403' :
                    \Log::alert('403 - ' . $request->url());
                    $out =  $this->preperViewError();
                    $out['title'] = 'Нет прав';
                    
                    return response()->view( 'errors.403',  $out );
                    
                    break;
            }
        }
        
        return parent::render($request, $exception);
    }
    
    private function preperViewError() {
        $obj = new \App\Http\Controllers\AppController();
        $navigation = view($obj->template . '.navigation')->
            with([
                'menu' => $obj->buildMenu()
            ])->render();
        
        return [ 'navigation' => $navigation ];
    }

    /**
     * Convert an authentication exception into an unauthenticated response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Illuminate\Auth\AuthenticationException  $exception
     * @return \Illuminate\Http\Response
     */
    protected function unauthenticated($request, AuthenticationException $exception)
    {
        if ($request->expectsJson()) {
            return response()->json(['error' => 'Unauthenticated.'], 401);
        }

        return redirect()->guest(route('login'));
    }
}
