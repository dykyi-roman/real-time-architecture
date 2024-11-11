<?php

declare(strict_types=1);

namespace App\Infrastructure\GuzzleClient;

use App\Infrastructure\GuzzleClient\DataExtractor\ResponseDataExtractor;
use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

final class GuzzleClient
{
    private ClientInterface $client;
    private ResponseDataExtractor $extractor;

    public function __construct(string $host, array $headers, ResponseDataExtractor $extractor)
    {
        $this->client = new Client([
            'base_uri' => $host,
            'verify' => false,
            'headers' => $headers
        ]);

        $this->extractor = $extractor;
    }

    public function post(array $data, string $uri = '')
    {
        $response = $this->send(new Request('POST', $uri, [], json_encode($data)));
        return $this->extractor->extract($response);
    }

    public function get(string $uri = '')
    {
        $response = $this->send(new Request('GET', $uri));

        return $this->extractor->extract($response);
    }


    private function send(RequestInterface $request, array $options = []): ResponseInterface
    {
        try {
            return $this->client->send($request, $options);
        } catch (GuzzleException) {
            return new Response();
        }
    }
}
