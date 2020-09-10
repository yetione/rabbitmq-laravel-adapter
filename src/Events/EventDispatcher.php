<?php


namespace Yetione\RabbitMQAdapter\Events;


use Illuminate\Contracts\Events\Dispatcher;
use Yetione\RabbitMQ\Event\EventDispatcherInterface;

class EventDispatcher implements EventDispatcherInterface
{
    protected Dispatcher $dispatcher;

    public function __construct(Dispatcher $dispatcher)
    {
        $this->dispatcher = $dispatcher;
    }

    public function dispatch($event)
    {
        $this->dispatcher->dispatch($event);
    }

    public function listen($eventName, $listener, $priority = null)
    {
        $this->dispatcher->listen($eventName, $listener);
    }
}