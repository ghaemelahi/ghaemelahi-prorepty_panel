<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // MARK:-> save logs , sms , replace number
        require_once app_path("Http/Helpers/helpers.php");

        // MARK:-> buyers information and store , update and delete buyers
        require_once app_path("Http/Helpers/buyers.php");


        // MARK:-> sellers information and store , update and delete sellers
        require_once app_path("Http/Helpers/sellers.php");


        // confing smsapi
        require_once app_path("Http/Helpers/config_sms.php");

        Paginator::useBootstrap();
    }
}
