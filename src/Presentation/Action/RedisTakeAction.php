<?php

namespace App\Presentation\Action;

use App\Domain\Notification\RedisTakeDomain;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @example https://redis.io/commands/blpop
 */
final class RedisTakeAction
{
    /**
     * @param RedisTakeDomain $domain
     *
     * @return JsonResponse
     *
     * @Route("/redis/take", name="redis_take")
     */
    public function __invoke(RedisTakeDomain $domain)
    {
        return new JsonResponse($domain());
    }
}
