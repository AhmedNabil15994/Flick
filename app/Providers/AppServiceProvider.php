<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
        $this->app->bind(
            \Modules\Core\Packages\Influencer\Contracts\InstagramStatisticInterface::class,
            \Modules\Core\Packages\Influencer\IQData\Instagram::class
        );
        $this->app->bind(
            \Modules\Core\Packages\Influencer\Contracts\YoutubeStatisticInterface::class,
            \Modules\Core\Packages\Influencer\IQData\Youtube::class
        );
        $this->app->bind(
            \Modules\Core\Packages\Influencer\Contracts\TiktokStatisticInterface::class,
            \Modules\Core\Packages\Influencer\IQData\Tiktok::class
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
