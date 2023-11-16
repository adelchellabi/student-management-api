<?php

namespace App\Providers;

use App\Packages\Students\Repositories\Eloquent\Repository;
use App\Packages\Students\Repositories\Eloquent\StudentsRepository;
use App\Packages\Students\Repositories\RepositoryInterface;
use App\Packages\Students\Repositories\StudentsRepositoryInterface;
use App\Packages\Students\Services\StudentsService;
use App\Packages\Students\Services\StudentsServiceInterface;
use Illuminate\Support\ServiceProvider;

class StudentsServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(RepositoryInterface::class, Repository::class);
        $this->app->bind(StudentsRepositoryInterface::class, StudentsRepository::class);
        $this->app->bind(StudentsServiceInterface::class, StudentsService::class);

    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__ . '/../Packages/Students/Database/Migrations');
    }
}
