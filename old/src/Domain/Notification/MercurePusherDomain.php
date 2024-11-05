<?php

namespace App\Domain\Notification;

use App\Domain\PayloadGenerator;
use App\Domain\VO\OperationTime;
use Symfony\Component\Mercure\Publisher;
use Symfony\Component\Mercure\Update;

final class MercurePusherDomain
{
    private const TOPICS = 'http://localhost/demo/books/1.jsonld';
    /**
     * Variable
     *
     * @var PayloadGenerator |
     */
    private $payload;
    /**
     * Variable
     *
     * @var Publisher |
     */
    private $publisher;

    /**
     * SymfonyPusherDomain constructor.
     *
     * @param Publisher        $publisher
     * @param PayloadGenerator $payload
     */
    public function __construct(Publisher $publisher, PayloadGenerator $payload)
    {
        $this->payload = $payload;
        $this->publisher = $publisher;
    }

    public function __invoke(int $count): OperationTime
    {
        $update = new Update(self::TOPICS, $this->payload->generateRequest());

        $startTime = microtime(true);

        $i = 1;
        while ($i <= $count) {
            $this->publisher->__invoke($update);
            $i++;
        }

        return new OperationTime($startTime, microtime(true));
    }
}
