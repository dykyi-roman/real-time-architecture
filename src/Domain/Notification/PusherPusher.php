<?php

namespace App\Domain\Notification;

use App\Domain\PayloadGenerator;
use App\Domain\VO\OperationTime;
use Pusher\Pusher;
use Pusher\PusherException;

final class PusherPusher
{
    public function __construct(
        private readonly PayloadGenerator $payload,
        private $pusherAppId,
        private $pusherAppKey,
        private $pusherAppSecret,
    ) {
    }

    /**
     * @param int $count
     *
     * @return OperationTime
     */
    public function __invoke(int $count): OperationTime
    {
        return new OperationTime(
            function (int $count): void {
                try {
                    $pusher = new Pusher(
                        $this->pusherAppKey,
                        $this->pusherAppSecret,
                        $this->pusherAppId,
                        ['cluster' => 'eu', 'useTLS' => true]
                    );

                    $i = 1;
                    while ($i <= $count) {
                        $pusher->trigger('my-channel', 'my-event', $this->payload->generateRequest());
                        $i++;
                    }
                } catch (PusherException) {
                }
            },
            $count
        );
    }
}
