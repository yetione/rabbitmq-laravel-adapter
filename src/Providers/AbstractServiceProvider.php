<?php


namespace Yetione\RabbitMQAdapter\Providers;


use Illuminate\Support\ServiceProvider;
use Yetione\RabbitMQ\Configs\ConnectionsConfig;
use Yetione\RabbitMQ\Configs\Providers\ArrayConfigProvider;
use Yetione\RabbitMQ\Event\EventDispatcherInterface;
use Yetione\RabbitMQ\Service\RabbitMQService;
use Yetione\RabbitMQAdapter\Events\EventDispatcher;

class AbstractServiceProvider extends ServiceProvider
{

    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../../config/rabbitmq-connection.php',
            'rabbitmq-connection'
        );
        $this->app->singleton(ConnectionsConfig::class, static function ($app): ConnectionsConfig {
            return new ConnectionsConfig($app->make(ArrayConfigProvider::class, ['config'=>config('rabbitmq-connection')]));
        });
        $this->app->singleton(RabbitMQService::class);
        $this->app->singleton(EventDispatcherInterface::class, EventDispatcher::class);
    }

    public function boot()
    {
        $this->publishConfig();
    }

    protected function publishConfig()
    {
        $this->publishes([
            __DIR__.'/../../config/rabbitmq-connection.php' => config_path('rabbitmq-connection.php'),
            __DIR__.'/../../config/rabbitmq.php' => config_path('rabbitmq.php')
        ], 'rabbitmq-config');
    }
}