<?php use Yetione\RabbitMQ\Constant\Exchange as ExchangeTypes;
use Yetione\RabbitMQAdapter\Consumers\BasicConsumeConsumer;
use Yetione\RabbitMQAdapter\Consumers\BasicGetConsumer;
use Yetione\RabbitMQAdapter\Producers\BatchProducer;
use Yetione\RabbitMQAdapter\Producers\SingleProducer;

return [
    'producers'=>[
        'events'=>[
            'type'=>'single',
            'exchange'=>'events_root',
            'connection'=>'producer',
            'connection_alias'=>'events_producer',
            'auto_reconnect'=>true,
            'reconnect_retries'=>10,
            'reconnect_delay'=>800000,
            'reconnect_interval'=>500000,
            'publish_retries'=>3,
        ]
    ],
    'consumers'=> [
        'events.auth.users'=>[
            'type'=>'consume',
            'connection'=>'consumer',
            'connection_alias'=>'events.auth.user',
            'auto_reconnect'=>true,
            'reconnect_retries'=>10,
            'reconnect_delay'=>800000,
            'reconnect_interval'=>500000,
            'bindings'=>[
                'event_root'=>[
                    'type'=>'queue',
                    'target'=>''
                ]
            ]
        ]
    ],
    'queues'=>[
        'users_event'=>[
            'name'=>'shopify.app.users.events',
            'passive'=>false,
            'durable'=>false,
            'exclusive'=>true,
            'auto_delete'=>true
        ],
    ],
    'exchanges'=>[
        'events_root'=>[
            'name'=>'shopify.events',
            'type'=> ExchangeTypes::TYPE_TOPIC,
            'passive'=>true,
            'durable'=>true,
            'auto_delete'=>false,
            'internal'=>false,
            'nowait'=>false,
            'arguments'=>[
                'alternate-exchange'=>'shopify._events'
            ],
            'ticket'=>null,
            'declare'=>false,
            'temporary'=>false
        ],
        'events_root.alternate'=>[
            'name'=>'shopify._events_alternate',
            'type'=>ExchangeTypes::TYPE_FANOUT,
            'passive'=>true,
            'durable'=>true,
            'auto_delete'=>false,
            'internal'=>false,
        ]
    ],
    'producer_types'=>[
        'single'=> SingleProducer::class,
        'batch'=> BatchProducer::class
    ],
    'consumer_types'=>[
        'consume'=> BasicConsumeConsumer::class,
        'get'=> BasicGetConsumer::class
    ]
];
