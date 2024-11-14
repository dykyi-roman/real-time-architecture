<?php

declare(strict_types=1);

namespace App\Presentation\Action;

use App\Domain\Notification\MercurePusher;
use App\Presentation\Responder\NotificationJsonResponse;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @see https://symfony.com/blog/symfony-gets-real-time-push-capabilities
 */
final class MercureAction
{
    #[Route('/mercure/push/{count}', name: 'mercure_pusher')]
    public function __invoke(
        int $count,
        MercurePusher $domain,
        NotificationJsonResponse $response,
    ): NotificationJsonResponse {
        return $response($domain($count));
    }
}