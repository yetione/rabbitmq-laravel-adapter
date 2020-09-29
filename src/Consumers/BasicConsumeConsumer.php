<?php


namespace Yetione\RabbitMQAdapter\Consumers;

use PhpAmqpLib\Message\AMQPMessage;
use Yetione\RabbitMQ\Consumer\BasicConsumeConsumer as AbstractConsumer;
use Yetione\RabbitMQ\DTO\Queue;

class BasicConsumeConsumer extends AbstractConsumer
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