<?php

namespace App\Providers;

use App\Domain\Repositories\INodeTypeRepository;
use App\Domain\Repositories\IPbxSchemeNodeRelationRepository;
use App\Domain\Repositories\IPbxSchemeNodeRepository;
use App\Repositories\NodeTypeEloquentRepository;
use App\Repositories\PbxSchemeNodeEloquentRepository;
use App\Repositories\PbxSchemeNodeRelationEloquentRepository;
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
        $this->app->bind(
            INodeTypeRepository::class, function () {
            return new NodeTypeEloquentRepository();
        }
        );

        $this->app->bind(
            IPbxSchemeNodeRepository::class, function () {
            return new PbxSchemeNodeEloquentRepository();
        }
        );

        $this->app->bind(
            IPbxSchemeNodeRelationRepository::class, function () {
            return new PbxSchemeNodeRelationEloquentRepository();
        }
        );
    }
}
