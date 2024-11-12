<?php

declare(strict_types=1);

namespace App\Infrastructure\Kafka;

use RdKafka\Producer;
use RdKafka\ProducerTopic;

final readonly class KafkaProducer
{
    public function __construct(
        private Producer $producer,
    ) {
    }

    public function sendMessage(string $topicName, string $message): void
    {
        $topic = $this->producer->newTopic($topicName);
        $topic->produce(RD_KAFKA_PARTITION_UA, 0, $message);
        $this->producer->flush(10000);
    }
}
