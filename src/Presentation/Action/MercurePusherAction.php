<?php

declare(strict_types=1);

namespace App\Presentation\Action;

use App\Domain\Notification\MercurePusherDomain;
use App\Presentation\Responder\NotificationJsonResponse;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @example https://symfony.com/blog/symfony-gets-real-time-push-capabilities
 */
final class MercurePusherAction
{
    #[Route('/mercure/push/{count}', name: 'mercure_pusher')]
    public function __invoke(
        int $count,
        MercurePusherDomain $domain,
        NotificationJsonResponse $response,
    ): NotificationJsonResponse {
        return $response($domain($count));
    }
}