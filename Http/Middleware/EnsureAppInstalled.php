<?php

namespace Modules\Core\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Omaicode\Modules\Facades\Module;

class EnsureAppInstalled
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(!$request->routeIs('system.install*')) {
            if(!File::exists(storage_path('install')) && Module::has('System')) {
                return redirect()->route('system.install.index');
            }
        }

        return $next($request);
    }
}
