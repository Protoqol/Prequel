<?php

    namespace Protoqol\Prequel\Http\Middleware;

    use Closure;

    class Authorised {

        /**
         * Handle an incoming request.
         * Checks if Prequel is enabled.
         *
         * @param \Illuminate\Http\Request $request
         * @param \Closure                 $next
         *
         * @return mixed
         */
        public function handle($request, Closure $next) {
            return config('prequel.enabled')
                ? $next($request)
                : response('Prequel has been disabled.', 403);
        }
    }
