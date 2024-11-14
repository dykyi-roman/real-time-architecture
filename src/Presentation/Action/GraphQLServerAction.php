<?php

declare(strict_types=1);

namespace App\Presentation\Action;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use GraphQL\GraphQL;
use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Schema;
use GraphQL\Type\SchemaConfig;

final class GraphQLServerAction
{
    #[Route('/graphql', name: 'graphql_server', methods: ['GET', 'POST'])]
    public function __invoke(Request $request): JsonResponse
    {
        try {
            $queryType = new ObjectType([
                'name' => 'Query',
                'fields' => [
                    'echo' => [
                        'type' => Type::string(),
                        'args' => [
                            'message' => ['type' => Type::string()],
                        ],
                        'resolve' => static fn(
                            $rootValue,
                            array $args
                        ): string => $args['message'],
                    ],
                ],
            ]);

            $input = json_decode($request->getContent(), true);
            $result = GraphQL::executeQuery(
                new Schema(
                    (new SchemaConfig())
                        ->setQuery($queryType)
                        ->setMutation(null)
                ),
                $input['query'],
                null,
                null,
                $input['variables'] ?? null
            );
            $output = $result->toArray();
        } catch (\Throwable $exception) {
            $output = [
                'error' => [
                    'message' => $exception->getMessage(),
                ],
            ];
        }

        return new JsonResponse($output);
    }
}