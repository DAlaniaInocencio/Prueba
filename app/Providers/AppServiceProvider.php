<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Models\Post;
use App\Policies\PostPolicy;


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

    /**
    * The model to policy mappings for the application.
    *
    * @var array<class-string, class-string>
    */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
        Post::class => PostPolicy::class,

    ];
}

