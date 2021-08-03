<?php

namespace Latus\Content\Providers;

use Illuminate\Support\ServiceProvider;
use Latus\Content\Repositories\Contracts\ContentRepository;
use Latus\Content\Repositories\Contracts\ContentTranslationRepository;

class ContentServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        if (!$this->app->bound(ContentRepository::class)) {
            $this->app->bind(ContentRepository::class, \Latus\Content\Repositories\Eloquent\ContentRepository::class);
        }

        if (!$this->app->bound(ContentTranslationRepository::class)) {
            $this->app->bind(ContentTranslationRepository::class, \Latus\Content\Repositories\Eloquent\ContentTranslationRepository::class);
        }
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__ . '/../../database/migrations');
    }
}
