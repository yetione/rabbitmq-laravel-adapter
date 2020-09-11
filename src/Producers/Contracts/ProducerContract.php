<?php


namespace Yetione\RabbitMQAdapter\Producers\Contracts;


use Yetione\RabbitMQ\Connection\ConnectionInterface;
use Yetione\RabbitMQ\Event\EventDispatcherInterface;

interface ProducerContract
{
    public function __construct(array $config, ConnectionInterface $connection, EventDispatcherInterface $eventDispatcher);
}