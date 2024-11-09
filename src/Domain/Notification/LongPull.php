<?php

declare(strict_types=1);

namespace App\Domain\Notification;

use App\Domain\VO\OperationTime;

final readonly class LongPull
{
    public function __invoke(int $count): OperationTime
    {
        return new OperationTime(function (int $count): void {
            $i = 1;
            while ($i <= $count) {
                sleep(1);
                $i++;
            }
        }, $count);
    }
}