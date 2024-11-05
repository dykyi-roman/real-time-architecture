<?php

namespace App\Responder;

use App\Domain\VO\OperationTime;
use Symfony\Component\HttpFoundation\JsonResponse;

final class NotificationJsonResponse extends JsonResponse
{
    public function __invoke(OperationTime $operationTime)
    {
        return self::create([
            'status' => 'published',
            'time' => $operationTime->getExecutionTime()
        ]);
    }
}
