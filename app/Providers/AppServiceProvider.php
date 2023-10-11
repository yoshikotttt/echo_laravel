<?php

namespace App\Providers;

use App\Models\Notification;
use App\Policies\NotificationPolicy;
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
        //
    }

    protected $policies = [
        Notification::class => NotificationPolicy::class,
    ];

}
