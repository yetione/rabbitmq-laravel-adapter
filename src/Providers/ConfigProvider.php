<?php


namespace Yetione\RabbitMQAdapter\Providers;


use Yetione\RabbitMQ\Service\ConfigProviderInterface;

class ConfigProvider implements ConfigProviderInterface
{
    protected array $config;

    public function __construct(?array $config)
    {
        $this->config = null === $config ? [] : $config;
    }

    public function read(): array
    {
        return $this->config;
    }
}