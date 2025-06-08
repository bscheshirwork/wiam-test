<?php

use yii\queue\amqp_interop\Queue;

return [
    'class' => Queue::class,
    'host' => env('RABBITMQ_HOST', 'rabbitmq'),
    'port' => env('RABBITMQ_PORT', 5672),
    'user' => env('RABBITMQ_USER', 'guest'),
    'password' => env('RABBITMQ_PASSWORD', 'guest'),
    'exchangeName' => env('QUEUE_EXCHANGE_NAME', 'exchange'),
    'queueName' => env('QUEUE_NAME', 'queue'),
    'driver' => Queue::ENQUEUE_AMQP_LIB,
];
