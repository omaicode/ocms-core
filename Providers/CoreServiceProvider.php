<?php

namespace Modules\Core\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Routing\Events\RouteMatched;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Config as FacadesConfig;
use Illuminate\Support\Facades\Event;
use Modules\Core\Facades\Email;
use Modules\Core\Facades\Menu;
use Modules\Core\Supports\Config;
use Modules\Core\Supports\Helper;
use Modules\Core\View\Components\Breadcrumb;
use Modules\Core\View\Components\EmailTemplateEditor;

class CoreServiceProvider extends ServiceProvider
{
    /**
     * @var string $moduleName
     */
    protected $moduleName = 'Core';

    /**
     * @var string $moduleNameLower
     */
    protected $moduleNameLower = 'core';

    /**
     * Boot the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerTranslations();
        $this->registerConfig();
        $this->registerViews();
        $this->loadMigrationsFrom(module_path($this->moduleName, 'Database/Migrations'));
        $this->registerEmailTemplates();
        $this->loadMenus();
        $this->addComponents(); 
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(AuthServiceProvider::class);
        $this->app->register(ViewServiceProvider::class);
        $this->app->register(RouteServiceProvider::class);
        $this->app->register(RepositoryServiceProvider::class);
        $this->app->register(AnalyticsServiceProvider::class);

        Helper::autoload(base_path('modules/Core/Helpers'));
    }

    /**
     * Register config.
     *
     * @return void
     */
    protected function registerConfig()
    {
        $this->publishes([
            module_path($this->moduleName, 'Config/config.php') => config_path($this->moduleNameLower . '.php'),
        ], 'config');
        $this->mergeConfigFrom(
            module_path($this->moduleName, 'Config/config.php'), $this->moduleNameLower
        );
    }

    /**
     * Register views.
     *
     * @return void
     */
    public function registerViews()
    {
        $viewPath = resource_path('views/modules/' . $this->moduleNameLower);

        $sourcePath = module_path($this->moduleName, 'Resources/views');

        $this->publishes([
            $sourcePath => $viewPath
        ], ['views', $this->moduleNameLower . '-module-views']);

        $this->loadViewsFrom(array_merge($this->getPublishableViewPaths(), [$sourcePath]), $this->moduleNameLower);
    }

    /**
     * Register translations.
     *
     * @return void
     */
    public function registerTranslations()
    {
        $langPath = resource_path('lang/modules/' . $this->moduleNameLower);

        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, $this->moduleNameLower);
        } else {
            $this->loadTranslationsFrom(module_path($this->moduleName, 'Resources/lang'), $this->moduleNameLower);
        }
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

    private function getPublishableViewPaths(): array
    {
        $paths = [];
        foreach (FacadesConfig::get('view.paths') as $path) {
            if (is_dir($path . '/modules/' . $this->moduleNameLower)) {
                $paths[] = $path . '/modules/' . $this->moduleNameLower;
            }
        }
        return $paths;
    }

    public function addComponents()
    {
        Blade::componentNamespace("Modules\\Core\\View\\Components\\Forms", 'forms');
        Blade::component(Breadcrumb::class, 'breadcrumb');
        Blade::component(EmailTemplateEditor::class, 'email-template-editor');
    }

    public function registerEmailTemplates()
    {
        if(FacadesConfig::has("{$this->moduleNameLower}.email_templates")) {
            $templates = FacadesConfig::get("{$this->moduleNameLower}.email_templates");

            if(is_array($templates) && count($templates) > 0) {
                foreach($templates as $name => $data) {
                    if(is_string($name) && !blank($data) && is_array($data)) {
                        Email::addTemplate($name, $data);
                    }
                }
            }
        }
    }

    public function loadMenus()
    {
        Event::listen(RouteMatched::class, function() {
            $menu_path = module_path($this->moduleName, 'Config/menu.php');

            if(file_exists($menu_path)) {
                $menus = include $menu_path;

                foreach($menus as $menu) {
                    Menu::add($menu);
                }
            }
        });        
    }
}
