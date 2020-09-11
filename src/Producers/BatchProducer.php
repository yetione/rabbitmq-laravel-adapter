<?php


namespace Yetione\RabbitMQAdapter\Producers;

use Yetione\RabbitMQ\Connection\ConnectionInterface;
use Yetione\RabbitMQ\DTO\Exchange;
use Yetione\RabbitMQ\Event\EventDispatcherInterface;
use Yetione\RabbitMQ\Producer\BatchProducer as RabbitMQBatchProducer;
use Yetione\RabbitMQAdapter\Producers\Contracts\ProducerContract;

class BatchProducer extends RabbitMQBatchProducer implements ProducerContract
{
    public function __construct(array $config, ConnectionInterface $connection, EventDispatcherInterface $eventDispatcher)
    {
        parent::__construct($connection, $eventDispatcher);
    }

    protected function createExchange(): Exchange
    {
        // TODO: Implement createExchange() method.
    }
}