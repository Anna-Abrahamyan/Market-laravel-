<?php

namespace App\Providers;

use App\Repository\Read\User\UserReadRepository;
use App\Repository\Read\User\UserReadRepositoryInterface;
use App\Repository\Write\User\UserWriteRepository;
use App\Repository\Write\User\UserWriteRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(UserReadRepositoryInterface::class, UserReadRepository::class);
        $this->app->bind(UserWriteRepositoryInterface::class, UserWriteRepository::class);
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
