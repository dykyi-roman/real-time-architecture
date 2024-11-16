<?php

declare(strict_types=1);

namespace App\Infrastructure\Kafka;

use App\Domain\MessageProducerInterface;
use RdKafka\Conf;
use RdKafka\Producer;
use RdKafka\ProducerTopic;
use RdKafka\KafkaConsumer;
use RdKafka\Message;

final readonly class KafkaProducer implements MessageProducerInterface
{
    public function __construct(
        private Producer $producer,
        private string $kafkaHost,
    ) {
    }

    public function sendMessage(string $topicName, string $message): void
    {
        $topic = $this->producer->newTopic($topicName);
        $topic->produce(RD_KAFKA_PARTITION_UA, 0, $message);
        $this->producer->flush(10000);
    }

    public function consumeMessages(int $timeoutMs, array $topics, callable $callback): void
    {
        $conf = new Conf();
        $conf->set('group.id', 'myGroup');
        $conf->set('metadata.broker.list', $this->kafkaHost);
        $conf->set('enable.auto.commit', 'false');

        $consumer = new KafkaConsumer($conf);
        $consumer->subscribe($topics);

        while (true) {
            $message = $consumer->consume($timeoutMs);
            switch ($message->err) {
                case RD_KAFKA_RESP_ERR_NO_ERROR:
                    $callback($message->payload);
                    break;
                case RD_KAFKA_RESP_ERR__PARTITION_EOF:
                    echo "No more messages; waiting for more..." . PHP_EOL;
                    break;
                case RD_KAFKA_RESP_ERR__TIMED_OUT:
                    echo "Timed out while waiting for a message." . PHP_EOL;
                    break;
                default:
                    throw new \RuntimeException($message->errstr(), $message->err);
            }
        }
    }
}
