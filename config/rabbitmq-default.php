<?php
use Yetione\RabbitMQ\Constant\Connection as ConnectionEnum;

return [
    'connectable' => [
        'auto_reconnect'=>true,
        'reconnect_retries'=>5,
        'reconnect_delay'=>500000
    ],
    'connection'=>[
        'insist'=>false,
        'login_method'=>ConnectionEnum::LOGIN_METHOD_AMQPPLAIN,
        'login_response'=> null,
        'locale'=> 'en_US',
        'connection_timeout'=> 3.0,
        'read_write_timeout'=> 130.0,
        'context_options'=> null,
        'context_params'=> null,
        'keepalive'=> false,
        'heartbeat'=> 0,
        'channel_rpc_timeout'=> 0.0,
        'ssl_protocol'=> null,
        'connection_type'=>ConnectionEnum::TYPE_STREAM_LAZY
    ],
];