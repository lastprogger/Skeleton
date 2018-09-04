<?php
/**
 * Created by PhpStorm.
 * User: alexpon
 * Date: 12/07/2017
 * Time: 12:55
 */

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Closure;
use App;
use Log;

class IdentifyLocaleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param Request $obRequest
     * @param Closure $next
     *
     * @return mixed
     * @throws \Exception
     */
    public function handle(Request $obRequest, Closure $next)
    {
        $fallbackLocale   = config('app.fallback_locale', 'en');
        $supportedLocales = explode(',', config('app.supported_locales'));

        if (!\in_array($fallbackLocale, $supportedLocales, true)) {
            throw new \RuntimeException('Fallback locale is not in supported locales list');
        }

        $localeHeader = config('app.custom_locale_header');
        if (null === $localeHeader) {
            Log::debug('Custom locale header not found');

            return $next($obRequest);
        }

        $sLocale = $obRequest->header($localeHeader);
        if (!\in_array($sLocale, $supportedLocales, true)) {
            $sLocale = $fallbackLocale;
        }

        App::setLocale($sLocale);

        return $next($obRequest);
    }
}
