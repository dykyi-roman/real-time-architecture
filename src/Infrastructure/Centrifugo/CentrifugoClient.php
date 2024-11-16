<?php

declare(strict_types=1);

namespace App\Infrastructure\Centrifugo;

use App\Domain\MessagesInterface;
use App\Infrastructure\Centrifugo\Response\ResponseException;
use App\Infrastructure\Centrifugo\Response\ResponseInterface;
use App\Infrastructure\Centrifugo\Response\ResponseResult;
use App\Infrastructure\GuzzleClient\DataExtractor\ResponseDataExtractor;
use App\Infrastructure\GuzzleClient\GuzzleClient;

final class CentrifugoClient implements MessagesInterface
{
    private GuzzleClient $client;

    public function __construct(string $host, string $apiKey = '')
    {
        $headers = [
            'Content-Type' => 'application/json',
            'Authorization' => 'apikey ' . $apiKey
        ];

        $this->client = new GuzzleClient($host, $headers, new ResponseDataExtractor());
    }

    /**
     * @inheritdoc
     */
    public function publish(string $channel, array $data = []): ResponseInterface
    {
        return $this->buildRequest('publish', ['channel' => $channel, 'data' => $data,]);
    }

    /**
     * @inheritdoc
     */
    public function broadcast(array $channels, array $data): ResponseInterface
    {
        return $this->buildRequest('broadcast', ['channels' => $channels, 'data' => $data,]);
    }

    /**
     * @inheritdoc
     */
    public function presence(string $channel): ResponseInterface
    {
        return $this->buildRequest('presence', ['channel' => $channel]);
    }

    /**
     * @inheritdoc
     */
    public function presenceStats(string $channel): ResponseInterface
    {
        return $this->buildRequest('presence_stats', ['channel' => $channel]);
    }

    /**
     * @inheritdoc
     */
    public function history(string $channel): ResponseInterface
    {
        return $this->buildRequest('history', ['channel' => $channel]);
    }

    /**
     * @inheritdoc
     */
    public function historyRemove(string $channel): ResponseInterface
    {
        return $this->buildRequest('unsubscribe', ['channel' => $channel]);
    }

    /**
     * @inheritdoc
     */
    public function unsubscribe(string $channel, int $userId): ResponseInterface
    {
        return $this->buildRequest('unsubscribe', ['channel' => $channel, 'user' => $userId,]);
    }

    /**
     * @inheritdoc
     */
    public function disconnect(int $userId): ResponseInterface
    {
        return $this->buildRequest('disconnect', ['user' => $userId]);
    }

    /**
     * @inheritdoc
     */
    public function channels(): ResponseInterface
    {
        return $this->buildRequest('channels');
    }

    /**
     * @inheritdoc
     */
    public function info(): ResponseInterface
    {
        return $this->buildRequest('info');
    }

    private function buildRequest(string $method, array $params = [], $uri = '/api'): ResponseInterface
    {
        $response = $this->client->post([
            'method' => $method,
            'params' => $params,
        ], $uri);

        if (isset($response->error)) {
            return new ResponseException($response->error);
        }

        if (isset($response->result)) {
            return new ResponseResult($response->result);
        }

        return new ResponseResult(new \stdClass());
    }
}
