<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Overtrue\EasySms\EasySms;

/**
 * 信息服务
 *
 * Class EasySmsServiceProvider
 * @package App\Providers
 */
class EasySmsServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
       $this->app->singleton(EasySms::class, function ($app) {
          return new EasySms(config('easysms'));
       });

       $this->app->alias(EasySms::class,'easysms');
    }
}
