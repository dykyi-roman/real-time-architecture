<?php

declare(strict_types=1);

namespace App\Presentation\Action;

use App\Domain\Notification\RedisPubSubDomain;
use App\Presentation\Responder\NotificationJsonResponse;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @example https://redis.io/commands/blpop
 */
final class RedisPubSubAction
{
    #[Route('/redis-pubsub/push/{count}', name: 'redis_pubsub_pusher')]
    public function __invoke(
        int $count,
        RedisPubSubDomain $domain,
        NotificationJsonResponse $response,
    ): NotificationJsonResponse {
        return $response($domain($count));
    }
}
