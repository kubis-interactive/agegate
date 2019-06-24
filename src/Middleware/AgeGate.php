<?php

namespace Kubis\AgeGate\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\URL;

class AgeGate
{
    const AGE_GATE_COOKIE_VALUE = "legal-age";
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null) {
        View::share('age_gate', false);
        $age_gate = $request->cookie(config('agegate.cookie_name'));
        if(
            ($age_gate && $age_gate == self::AGE_GATE_COOKIE_VALUE) || 
            ( 
                preg_match('/^FacebookExternalHit\/.*?/i', $request->userAgent()) || 
                ( config('app.env') == 'local' && $request->get('passthrough') == 'yes' )
            )
            ) {

            View::share('age_gate', self::AGE_GATE_COOKIE_VALUE);

        } else if(!$age_gate || $age_gate != self::AGE_GATE_COOKIE_VALUE) {
            return redirect()->route('age-gate.redirect', [
                'return' => $request->input('return') ? rawurldecode($request->input('return')) : URL::current()
            ]);
        }
        return $next($request);
    }
}
