<?php

declare(strict_types=1);

namespace App\Domain\Notification;

use App\Domain\VO\OperationTime;

final readonly class GraphQLPusher
{
    public function __construct(
        private string $graphqlHost,
    ) {
    }

    public function __invoke(int $count): OperationTime
    {
        $graphqlHost = $this->graphqlHost;
        return new OperationTime(function (int $count) use ($graphqlHost): void  {
            $i = 1;
            while ($i <= $count) {
                $this->sendGraphQLRequest($graphqlHost);
                $i++;
            }
        }, $count);
    }

    private function sendGraphQLRequest(string $graphqlHost): void
    {
        $query = [
            'query' => 'query { echo(message: "Test message") }'
        ];

        $ch = curl_init($graphqlHost);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($query));

        curl_exec($ch);
        if (curl_errno($ch)) {
            echo 'cURL error: ' . curl_error($ch);
        }

        curl_close($ch);
    }
}