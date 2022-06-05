<?php

namespace App\Providers;

use App\Repository\categoryRepository;
use App\Repository\categoryRepositoryInterface;
use App\Repository\postRepository;
use App\Repository\postRepositoryInterface;
use App\Repository\tagRepository;
use App\Repository\tagRepositoryInterface;
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
        $this->app->bind(categoryRepositoryInterface::class, categoryRepository::class);
        $this->app->bind(tagRepositoryInterface::class, tagRepository::class);
        $this->app->bind(postRepositoryInterface::class, postRepository::class);
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
