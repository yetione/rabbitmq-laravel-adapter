<?php


namespace Yetione\RabbitMQAdapter\Producers;

use Yetione\RabbitMQ\Connection\ConnectionInterface;
use Yetione\RabbitMQ\DTO\Exchange;
use Yetione\RabbitMQ\Event\EventDispatcherInterface;
use Yetione\RabbitMQ\Producer\SingleProducer as RabbitMQSingleProducer;
use Yetione\RabbitMQAdapter\Producers\Contracts\ProducerContract;

class SingleProducer extends RabbitMQSingleProducer implements ProducerContract
{
}