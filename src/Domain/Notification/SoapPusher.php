<?php

declare(strict_types=1);

namespace App\Domain\Notification;

use App\Domain\PayloadGenerator;
use App\Domain\VO\OperationTime;

final readonly class SoapPusher
{
    public function __construct(
        private PayloadGenerator $payload,
        private string $soapUrl,
    ) {
    }

    public function __invoke(int $count): OperationTime
    {
        return new OperationTime(function (int $count): void  {
            $i = 1;
            $client = new \SoapClient(null, [
                'location' => $this->soapUrl,
                'uri' => $this->soapUrl,
                'trace' => 1,
            ]);

            while ($i <= $count) {
                $client->__soapCall('sendMessage', [
                    'message' => $this->payload->generateRequest(),
                ]);
                $i++;
            }
        }, $count);
    }

}