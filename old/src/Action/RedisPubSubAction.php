<?php

namespace App\Action;

use App\Domain\Notification\RedisPubSubDomain;
use App\Responder\NotificationJsonResponse;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @example https://redis.io/commands/blpop
 */
final class RedisPubSubAction
{
    /**
     * @param int                      $count
     * @param RedisPubSubDomain        $domain
     * @param NotificationJsonResponse $response
     *
     * @return JsonResponse
     *
     * @Route("/redis-pubsub/push/{count}", name="redis_pubsub_pusher")
     */
    public function __invoke(int $count, RedisPubSubDomain $domain, NotificationJsonResponse $response)
    {
        return $response($domain($count));
    }
}
