<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Repository\Eloquent\BaseRepository;use App\Repository\EloquentRepositoryInterface;
use App\Repository\Eloquent\UserRepository;use App\Repository\UserRepositoryInterface;
use App\Repository\Eloquent\SiteSettingRepository;use App\Repository\SiteSettingRepositoryInterface;
use App\Repository\Eloquent\RoleRepository;use App\Repository\RoleRepositoryInterface;
use App\Repository\Eloquent\PermissionRepository;use App\Repository\PermissionRepositoryInterface;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(EloquentRepositoryInterface::class,BaseRepository::class);
        $this->app->bind(UserRepositoryInterface::class,UserRepository::class);
        $this->app->bind(SiteSettingRepositoryInterface::class,SiteSettingRepository::class);
        $this->app->bind(RoleRepositoryInterface::class,RoleRepository::class);
        $this->app->bind(PermissionRepositoryInterface::class,PermissionRepository::class); 
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
