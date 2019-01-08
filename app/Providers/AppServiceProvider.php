<?php

namespace App\Providers;

use App\Observers\PostObserver;
use App\Post;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Schema::defaultStringLength(191);

        Post::observe(PostObserver::class);
    }

    public function register()
    {
        //
    }
}