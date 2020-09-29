<?php


namespace Yetione\RabbitMQAdapter\Producers;

use Yetione\RabbitMQ\Producer\BatchProducer as RabbitMQBatchProducer;
use Yetione\RabbitMQAdapter\Producers\Contracts\ProducerContract;

class BatchProducer extends RabbitMQBatchProducer implements ProducerContract
{

}