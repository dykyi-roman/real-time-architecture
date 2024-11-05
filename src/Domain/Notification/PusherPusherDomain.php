<?php

namespace App\Domain\Notification;

use App\Domain\PayloadGenerator;
use App\Domain\VO\OperationTime;
use Pusher\Pusher;
use Pusher\PusherException;

final class PusherPusherDomain
{
    /**
     * Variable
     *
     * @var PayloadGenerator |
     */
    private $payload;

    /**
     * SymfonyPusherDomain constructor.
     *
     * @param PayloadGenerator $payload
     */
    public function __construct(PayloadGenerator $payload)
    {
        $this->payload = $payload;
    }

    /**
     * @param int $count
     *
     * @return OperationTime
     */
    public function __invoke(int $count): OperationTime
    {
        $startTime = microtime(true);
        try {
            $pusher = new Pusher(
                $_SERVER['PUSHER_KEY'],
                $_SERVER['PUSHER_SECRET'],
                $_SERVER['PUSHER_APP_ID'],
                ['cluster' => 'eu', 'useTLS' => true]
            );

            $i = 1;
            while ($i <= $count) {
                $pusher->trigger('my-channel', 'my-event', $this->payload->generateRequest());
                $i++;
            }
        } catch (PusherException $e) {

        }

        return new OperationTime($startTime, microtime(true));
    }
}
