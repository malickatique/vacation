<?php

namespace App\Providers;

use Log;
use Monolog\Handler\ChromePHPHandler;
use Monolog\Formatter\ChromePHPFormatter;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Log::listen(function () {

            $monolog = Log::getMonolog();

            if (env('APP_ENV') === 'local') {
                $monolog->pushHandler($chromeHandler = new ChromePHPHandler());
                $chromeHandler->setFormatter(new ChromePHPFormatter());
            }
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //Uncomment it for Live server
        // $this->app->bind('path.public', function() {
        // 	return '/home4/demoaspi/public_html/2019/ovr/';});
        //
        Schema::defaultStringLength(191);
    }
}
