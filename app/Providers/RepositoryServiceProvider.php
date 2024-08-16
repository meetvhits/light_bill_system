<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Interfaces\UserRepositoryInterface;
use App\Interfaces\BillChargeRepositoryInterface;
use App\Interfaces\CustomerRepositoryInterface;
use App\Interfaces\LightBillRepositoryInterface;
use App\Interfaces\UnitRangeRepositoryInterface;

use App\Repositories\BillChargeRepository;
use App\Repositories\UserRepository;
use App\Repositories\CustomerRepository;
use App\Repositories\LightBillRepository;
use App\Repositories\UnitRangeRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(UserRepositoryInterface::class, function ($app) {
            return $app->make(UserRepository::class);
        });

        $this->app->bind(CustomerRepositoryInterface::class, function ($app) {
            return $app->make(CustomerRepository::class);
        });

        $this->app->bind(UnitRangeRepositoryInterface::class, function ($app) {
            return $app->make(UnitRangeRepository::class);
        });

        $this->app->bind(BillChargeRepositoryInterface::class, function ($app) {
            return $app->make(BillChargeRepository::class);
        });

        $this->app->bind(LightBillRepositoryInterface::class, function ($app) {
            return $app->make(LightBillRepository::class);
        });
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
