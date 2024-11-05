<?php

namespace App\Presentation\Action;

use App\Domain\Notification\RabbitMQPusherDomain;
use App\Responder\NotificationJsonResponse;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @example https://redis.io/commands/blpop
 */
final class RabbitMQPusherAction
{
    /**
     * @param int                      $count
     * @param RabbitMQPusherDomain     $domain
     * @param NotificationJsonResponse $response
     *
     * @return JsonResponse
     *
     * @Route("/rabbitmq/push/{count}", name="rabbitmq_pusher")
     */
    public function __invoke(int $count, RabbitMQPusherDomain $domain, NotificationJsonResponse $response)
    {
        return $response($domain($count));
    }
}
