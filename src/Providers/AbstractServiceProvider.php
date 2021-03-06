<?php


namespace Yetione\RabbitMQAdapter\Providers;


use Illuminate\Support\ServiceProvider;
use Yetione\RabbitMQ\Configs\ConnectionsConfig;
use Yetione\RabbitMQ\Configs\ConsumersConfig;
use Yetione\RabbitMQ\Configs\DefaultConfig;
use Yetione\RabbitMQ\Configs\ExchangesConfig;
use Yetione\RabbitMQ\Configs\ProducersConfig;
use Yetione\RabbitMQ\Configs\Providers\ArrayConfigProvider;
use Yetione\RabbitMQ\Configs\QueuesConfig;
use Yetione\RabbitMQ\Connection\ConnectionFactory;
use Yetione\RabbitMQ\Consumer\ConsumerFactory;
use Yetione\RabbitMQ\Event\EventDispatcherInterface;
use Yetione\RabbitMQ\Logger\LoggerProviderInterface;
use Yetione\RabbitMQ\Producer\ProducerFactory;
use Yetione\RabbitMQ\Queue\QueueFactory;
use Yetione\RabbitMQ\Service\RabbitMQService;
use Yetione\RabbitMQAdapter\Events\EventDispatcher;
use Yetione\RabbitMQAdapter\Logger\LaravelLoggerProvider;

class AbstractServiceProvider extends ServiceProvider
{

    public function register()
    {
        $this->app->singleton(LoggerProviderInterface::class, LaravelLoggerProvider::class);
        $this->mergeConfigFrom(
            __DIR__.'/../../config/rabbitmq-default.php',
            'rabbitmq-default'
        );
        $this->app->singleton(DefaultConfig::class, static function ($app): DefaultConfig {
            return new DefaultConfig(
                $app->make(ArrayConfigProvider::class, ['config'=>config('rabbitmq-default')])
            );
        });

        $this->mergeConfigFrom(
            __DIR__.'/../../config/rabbitmq-connection.php',
            'rabbitmq-connection'
        );
        $this->app->singleton(ConnectionsConfig::class, static function ($app): ConnectionsConfig {
            return new ConnectionsConfig(
                $app->make(ArrayConfigProvider::class, ['config'=>config('rabbitmq-connection')])
            );
        });

        $this->mergeConfigFrom(
            __DIR__.'/../../config/rabbitmq.php',
            'rabbitmq'
        );
        $this->app->singleton(ProducersConfig::class, static function ($app): ProducersConfig {
            return new ProducersConfig($app->make(DefaultConfig::class),
                $app->make(ArrayConfigProvider::class, ['config'=>config('rabbitmq.producers')]));
        });
        $this->app->singleton(ExchangesConfig::class, static function ($app): ExchangesConfig {
            return new ExchangesConfig($app->make(DefaultConfig::class),
                $app->make(ArrayConfigProvider::class, ['config'=>config('rabbitmq.exchanges')]));
        });
        $this->app->singleton(QueuesConfig::class, static function($app): QueuesConfig {
            return new QueuesConfig($app->make(DefaultConfig::class),
                $app->make(ArrayConfigProvider::class, ['config'=>config('rabbitmq.queues')]));
        });
        $this->app->singleton(ConsumersConfig::class, static function($app): ConsumersConfig {
            return new ConsumersConfig($app->make(DefaultConfig::class),
                $app->make(ArrayConfigProvider::class, ['config'=>config('rabbitmq.consumers')]));
        });
        $this->app->singleton(QueueFactory::class, static function($app): QueueFactory {
            return new QueueFactory($app->make(QueuesConfig::class));
        });
        $this->app->singleton(ConnectionFactory::class, static function ($app): ConnectionFactory {
            return new ConnectionFactory($app->make(ConnectionsConfig::class), $app->make(LaravelLoggerProvider::class));
        });


        $this->app->singleton(RabbitMQService::class);
        $this->app->singleton(EventDispatcherInterface::class, EventDispatcher::class);

        $this->app->singleton(ProducerFactory::class, static function ($app): ProducerFactory {
            $producerFactory = new ProducerFactory(
                $app->make(ProducersConfig::class),
                $app->make(ExchangesConfig::class),
                $app->make(ConnectionFactory::class),
                $app->make(EventDispatcher::class),
                $app->make(LaravelLoggerProvider::class)
            );
            return tap($producerFactory, function (ProducerFactory $factory) {
                foreach (config('rabbitmq.producer_types', []) as $type => $producerClass) {
                    $factory->addProducerType($type, $producerClass);
                }
            });
        });

        $this->app->singleton(ConsumerFactory::class, static function ($app): ConsumerFactory {
            $consumersFactory = new ConsumerFactory(
                $app->make(ConsumersConfig::class),
                $app->make(ConnectionFactory::class),
                $app->make(EventDispatcher::class),
                $app->make(LaravelLoggerProvider::class)
            );
            return tap($consumersFactory, function (ConsumerFactory $factory) {
                foreach (config('rabbitmq.consumer_types', []) as $type => $producerClass) {
                    $factory->addConsumerType($type, $producerClass);
                }
            });
        });
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