<?php

declare(strict_types=1);

namespace App\Presentation\Action;

use App\Domain\Notification\SoapPusher;
use App\Presentation\Responder\NotificationJsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class SoapAction
{
    #[Route('/soap/push/{count}', name: 'soap_pusher')]
    public function __invoke(
        int $count,
        SoapPusher $domain,
        NotificationJsonResponse $response,
    ): Response {
        return $response($domain($count));
    }
}