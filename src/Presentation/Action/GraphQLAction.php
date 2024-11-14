<?php

declare(strict_types=1);

namespace App\Presentation\Action;

use App\Domain\Notification\GraphQLPusher;
use App\Presentation\Responder\NotificationJsonResponse;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @see https://github.com/webonyx/graphql-php
 */
final class GraphQLAction
{
    #[Route('/graphql/push/{count}', name: 'graphql_pusher')]
    public function __invoke(
        int $count,
        GraphQLPusher $domain,
        NotificationJsonResponse $response
    ): NotificationJsonResponse {
        return $response($domain($count));
    }
}