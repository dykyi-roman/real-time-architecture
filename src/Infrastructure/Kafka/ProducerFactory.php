<?php

declare(strict_types=1);

namespace App\Infrastructure\Kafka;

use RdKafka\Producer;

final class ProducerFactory
{
    public static function create(string $kafkaHost): Producer
    {
        $producer = new Producer();
        $producer->addBrokers($kafkaHost);

        return $producer;
    }
}