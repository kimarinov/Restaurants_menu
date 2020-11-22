<?php

namespace App\Providers;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
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
    Schema::defaultStringLength(191);
    view()->composer('layouts.admin', function ($view) {
      $theme = \Cookie::get('theme');
      if ($theme != 'dark' && $theme != 'light') {
        $theme = 'light';
      }

      $view->with('theme', $theme);
    });
  }
}
