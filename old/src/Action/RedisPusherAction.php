<?php

namespace App\Action;

use App\Domain\Notification\RedisPusherDomain;
use App\Responder\NotificationJsonResponse;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @example https://redis.io/commands/blpop
 */
final class RedisPusherAction
{
    /**
     * @param int                      $count
     * @param RedisPusherDomain        $domain
     * @param NotificationJsonResponse $response
     *
     * @return JsonResponse
     *
     * @Route("/redis/push/{count}", name="redis_pusher")
     */
    public function __invoke(int $count, RedisPusherDomain $domain, NotificationJsonResponse $response)
    {
        return $response($domain($count));
    }
}
