<?php

declare(strict_types=1);

namespace App\Presentation\Action;

use App\Domain\Notification\LongPull;
use App\Presentation\Responder\NotificationJsonResponse;
use Symfony\Component\Routing\Annotation\Route;

final class LongPollAction
{
    #[Route('/long-pull/push/{count}', name: 'long-pull_pusher')]
    public function __invoke(
        int $count,
        LongPull $domain,
        NotificationJsonResponse $response
    ): NotificationJsonResponse {
        return $response($domain($count));
    }
}