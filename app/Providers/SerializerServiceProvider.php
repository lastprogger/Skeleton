<?php

namespace App\Providers;

use Doctrine\Common\Annotations\SimpleAnnotationReader;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use JMS\Serializer\SerializationContext;
use JMS\Serializer\SerializerBuilder;
use JMS\Serializer\SerializerInterface;

class SerializerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(
            SerializerInterface::class,
            function (Application $app) {
                $builder           = new SerializerBuilder();
                $debug             = config('app.debug');
                $environment       = $app->environment();
                $serializerBuilder = $builder::create();
                $route             = Route::current();
                $apiVersion        = null;

                if ($route !== null) {
                    $apiVersion = $route->parameter('version', null);
                }

                if ($environment === 'production') {
                    $serializerBuilder->setCacheDir(config('serializer.cache_dir.path'));
                }

                $serializerBuilder->addMetadataDir(config('serializer.definition.path'))
                                  ->setAnnotationReader(new SimpleAnnotationReader())
                                  ->setSerializationContextFactory(
                                      function () use ($apiVersion) {
                                          $context = SerializationContext::create();
                                          $context->setSerializeNull(
                                              config('serializer.definition.serialize_nulls', false)
                                          );

                                          if ($apiVersion !== null) {
                                              $context->setVersion($apiVersion);
                                          }

                                          return $context;
                                      }
                                  )->setDebug($debug)
                                  ->setAnnotationReader(new SimpleAnnotationReader());

                return $serializerBuilder->build();
            }
        );
    }
}
