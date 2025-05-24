<?php

namespace Modules\Influencer\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Factory;

class InfluencerServiceProvider extends ServiceProvider
{
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
        $this->registerFactories();
        $this->loadMigrationsFrom(module_path('Influencer', 'Database/Migrations'));
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(RouteServiceProvider::class);
    }

    /**
     * Register config.
     *
     * @return void
     */
    protected function registerConfig()
    {
        $this->publishes([
            module_path('Influencer', 'Config/config.php') => config_path('influencer.php'),
        ], 'config');
        $this->mergeConfigFrom(
            module_path('Influencer', 'Config/config.php'), 'influencer'
        );
    }

    /**
     * Register views.
     *
     * @return void
     */
    public function registerViews()
    {
        $viewPath = resource_path('views/modules/influencer');

        $sourcePath = module_path('Influencer', 'Resources/views');

        $this->publishes([
            $sourcePath => $viewPath
        ],'views');

        $this->loadViewsFrom(array_merge(array_map(function ($path) {
            return $path . '/modules/influencer';
        }, \Config::get('view.paths')), [$sourcePath]), 'influencer');
    }

    /**
     * Register translations.
     *
     * @return void
     */
    public function registerTranslations()
    {
        $langPath = resource_path('lang/modules/influencer');

        $attributesPath = module_path('Influencer','Resources/lang/'.app()->getLocale().'/attributes.php');
        if(file_exists($attributesPath))
            setValidationAttributes(include $attributesPath);

        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, 'influencer');
        } else {
            $this->loadTranslationsFrom(module_path('Influencer', 'Resources/lang'), 'influencer');
        }
    }

    /**
     * Register an additional directory of factories.
     *
     * @return void
     */
    public function registerFactories()
    {
        if (! app()->environment('production') && $this->app->runningInConsole()) {
            app(Factory::class)->load(module_path('Influencer', 'Database/factories'));
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
}
