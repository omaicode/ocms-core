<?php
 
namespace Modules\Core\Providers;

use AdminAsset;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\View\View as ViewView;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function boot()
    { 
        // Using Closure based composers...
        View::composer('*', function ($view) {

        });
    }
 
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}