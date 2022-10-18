<?php

namespace Modules\Core\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(\Modules\Core\Contracts\AdminPage::class, \Modules\Core\Supports\AdminPage::class);
        $this->app->bind(\Modules\Core\Repositories\AdminActivityRepository::class, \Modules\Core\Repositories\AdminActivityRepositoryEloquent::class);
        //:end-bindings:
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }
}
