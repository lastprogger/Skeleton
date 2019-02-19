@servers(['prod' => ['root@37.46.132.164']])

@task('deploy', ['on' => 'prod'])
    cd /var/www/SkeletonService
    git pull
    composer install
    php artisan migrate
    php artisan migrate:refresh --env=testing --seed
    vendor/bin/phpunit
@endtask
