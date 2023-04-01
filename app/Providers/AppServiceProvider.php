<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use DB;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Schema;
use App;
use Request;
use App\Models\PageDetail;
use App\Models\SiteSetting;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(RepositoryServiceProvider::class);
        if ($this->app->environment('local')) {
            $this->app->register(\Laravel\Telescope\TelescopeServiceProvider::class);
            $this->app->register(TelescopeServiceProvider::class);
        }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
    }
}
