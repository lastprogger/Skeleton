<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register(): void
    {
        // $this->app->bind(IEntityNameRepository::class, function ($app) {
        //     return new EntityNameRepository(
        //         $app['em'],
        //         $app['em']->getClassMetaData(EntityName::class)
        //     );
        // });
    }
}
