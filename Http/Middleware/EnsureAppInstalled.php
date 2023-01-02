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
        if(!$request->routeIs('LaravelInstaller::*')) {
            if(!File::exists(storage_path('installed'))) {
                return redirect('/install');
            }
        }

        if($request->routeIs('LaravelInstaller::*')) {
            if(File::exists(storage_path('installed'))) {
                return abort(404);
            }            
        }

        return $next($request);
    }
}
