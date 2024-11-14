<?php

declare(strict_types=1);

namespace App\Presentation\Action;

use App\Domain\Notification\KafkaPusher;
use App\Presentation\Responder\NotificationJsonResponse;
use Symfony\Component\Routing\Annotation\Route;

final class KafkaAction
{
    #[Route('/kafka/push/{count}', name: 'kafka_pusher')]
    public function __invoke(
        int $count,
        KafkaPusher $domain,
        NotificationJsonResponse $response
    ): NotificationJsonResponse {
        return $response($domain($count));
    }
}
