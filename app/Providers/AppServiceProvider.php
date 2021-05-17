<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use App\Models\FanArt;

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
        //
//        view()->composer('templates.internal', function($view) {
//
//            $fanarts = DB::table('Fanart')->get();
//
//            $view->with('fanarts', $fanarts);
//
//        });
        Schema::defaultStringLength(191);
    }

}
