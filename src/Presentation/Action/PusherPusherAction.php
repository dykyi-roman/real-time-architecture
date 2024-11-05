<?php

namespace App\Presentation\Action;

use App\Domain\Notification\PusherPusherDomain;
use App\Responder\NotificationJsonResponse;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @example https://pusher.com/docs
 * @example https://dashboard.pusher.com/apps/747455/getting_started
 */
final class PusherPusherAction
{
    /**
     * @param int                      $count
     * @param PusherPusherDomain       $domain
     * @param NotificationJsonResponse $response
     *
     * @return JsonResponse
     *
     * @Route("/pusher/push/{count}", name="pusher_pusher")
     */
    public function __invoke(int $count, PusherPusherDomain $domain, NotificationJsonResponse $response)
    {
        return $response($domain($count));
    }
}