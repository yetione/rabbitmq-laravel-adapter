<?php


namespace Yetione\RabbitMQAdapter\Logger;


use Illuminate\Log\Logger;
use Psr\Log\LoggerInterface;
use Yetione\RabbitMQ\Logger\LoggerProviderInterface;

class LaravelLoggerProvider implements LoggerProviderInterface
{
    protected Logger $logger;

    public function __construct(Logger $logger)
    {
        $this->logger = $logger;
    }

    public function getLogger(): LoggerInterface
    {
        return $this->logger;
    }
}