<?php

namespace App\Action;

use App\Domain\Notification\MercurePusherDomain;
use App\Responder\NotificationJsonResponse;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @example https://symfony.com/blog/symfony-gets-real-time-push-capabilities
 */
final class MercurePusherAction
{
    /**
     * @param int                      $count
     * @param MercurePusherDomain      $domain
     * @param NotificationJsonResponse $response
     *
     * @return JsonResponse
     *
     * @Route("/mercure/push/{count}", name="mercure_pusher")
     */
    public function __invoke(int $count, MercurePusherDomain $domain, NotificationJsonResponse $response)
    {
        return $response($domain($count));
    }
}