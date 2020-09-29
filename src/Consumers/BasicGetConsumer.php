<?php


namespace Yetione\RabbitMQAdapter\Consumers;
use PhpAmqpLib\Message\AMQPMessage;
use Yetione\RabbitMQ\Consumer\BasicGetConsumer as AbstractConsumer;
use Yetione\RabbitMQ\DTO\Queue;
use Yetione\RabbitMQ\Exception\StopConsumerException;

class BasicGetConsumer extends AbstractConsumer
{

    protected function processMessage(AMQPMessage $message): int
    {
        // TODO: Implement processMessage() method.
    }

    protected function createQueue(): Queue
    {
        // TODO: Implement createQueue() method.
    }
}