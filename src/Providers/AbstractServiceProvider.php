<?php


namespace Yetione\RabbitMQAdapter\Providers;


use Illuminate\Support\ServiceProvider;
use Yetione\DTO\Serializer;
use Yetione\RabbitMQ\Event\EventDispatcherInterface;
use Yetione\RabbitMQ\Service\ConfigProviderInterface;
use Yetione\RabbitMQ\Service\ConfigService;
use Yetione\RabbitMQ\Service\RabbitMQService;
use Yetione\RabbitMQAdapter\Events\EventDispatcher;

class AbstractServiceProvider extends ServiceProvider
{

    public function register()
    {
        $this->registerSerializer();
        $this->mergeConfigFrom(
            __DIR__.'/../../config/rabbitmq.php',
            'rabbitmq'
        );
        $this->app->singleton(ConfigProviderInterface::class, static function ($app) {
            return new ConfigProvider(config('rabbitmq'));
        });
        $this->app->singleton(ConfigService::class);
        $this->app->singleton(RabbitMQService::class);
        $this->app->singleton(EventDispatcherInterface::class, EventDispatcher::class);
    }

    public function boot()
    {
        $this->publishConfig();
    }

    protected function registerSerializer()
    {
        $this->app->singleton(Serializer::class);
        $this->app->alias(Serializer::class, 'dto.serializer');
    }

    protected function publishConfig()
    {
        $this->publishes([
            __DIR__.'/../../config/rabbitmq.php' => config_path('rabbitmq.php')
        ], 'rabbitmq-config');
    }
}