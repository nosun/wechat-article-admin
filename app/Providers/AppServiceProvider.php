<?php

namespace App\Providers;

use App\Models\WechatArticle;
use App\Observers\WechatArticleObserver;
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
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        WechatArticle::observe(WechatArticleObserver::class);
    }
}
