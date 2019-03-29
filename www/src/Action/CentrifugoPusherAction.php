<?php

namespace App\Action;

use App\Domain\Notification\CentrifugoPusherDomain;
use App\Responder\NotificationJsonResponse;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

final class CentrifugoPusherAction
{
    /**
     * @param int                      $count
     * @param CentrifugoPusherDomain   $domain
     * @param NotificationJsonResponse $response
     *
     * @return JsonResponse
     *
     * @Route("/centrifugo/push/{count}", name="centrifugo_pusher")
     */
    public function __invoke(int $count, CentrifugoPusherDomain $domain, NotificationJsonResponse $response)
    {
        return $response($domain($count));
    }
}
