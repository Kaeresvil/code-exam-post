<?php

namespace App\Providers;

use App\Repository\Base\BaseRepository;
use App\Repository\Post\PostRepository;
use App\Repository\User\UserRepository;
use Illuminate\Support\ServiceProvider;
use App\Repository\Base\BaseRepositoryInterface;
use App\Repository\Post\PostRepositoryInterface;
use App\Repository\User\UserRepositoryInterface;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
          $this->app->bind(BaseRepositoryInterface::class, BaseRepository::class);
          $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
          $this->app->bind(PostRepositoryInterface::class, PostRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
