<?php use Yetione\RabbitMQ\Constant\Exchange as ExchangeTypes;
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
    'producers_types'=>[
        'single'=> SingleProducer::class,
        'batch'=> BatchProducer::class
    ]
];
