<?php

declare(strict_types=1);

namespace App\Presentation\Action;

use App\Domain\Notification\RabbitMQPusher;
use App\Presentation\Responder\NotificationJsonResponse;
use Symfony\Component\Routing\Annotation\Route;

final class RabbitMQAction
{
    #[Route('/rabbitmq/push/{count}', name: 'rabbitmq_pusher')]
    public function __invoke(
        int $count,
        RabbitMQPusher $domain,
        NotificationJsonResponse $response
    ): NotificationJsonResponse {
        return $response($domain($count));
    }
}
