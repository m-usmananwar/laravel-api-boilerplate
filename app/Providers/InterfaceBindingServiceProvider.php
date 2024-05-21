<?php

namespace App\Providers;

use App\Contracts\IUserRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\ServiceProvider;

class InterfaceBindingServiceProvider extends ServiceProvider
{
    const  BINDINGS = [
        IUserRepository::class => UserRepository::class,
    ];

    /**
     * Register services.
     */
    public function register(): void
    {
        foreach (self::BINDINGS as $interface => $repository) {
            $this->app->bind($interface, $repository);
        }
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
