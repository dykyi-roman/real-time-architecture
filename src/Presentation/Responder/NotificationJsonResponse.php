<?php

declare(strict_types=1);

namespace App\Presentation\Responder;

use App\Domain\VO\OperationTime;
use Symfony\Component\HttpFoundation\JsonResponse;

final class NotificationJsonResponse extends JsonResponse
{
    public function __invoke(OperationTime $operationTime): NotificationJsonResponse
    {
        return new self($operationTime->getExecutionTime());
    }
}
