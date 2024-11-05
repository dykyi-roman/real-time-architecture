<?php

namespace App\Domain\GuzzleClient;

use App\Domain\GuzzleClient\DataExtractor\ResponseDataExtractor;
use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

/**
 * Class GuzzleClient
 * @package Dykyi
 */
final class GuzzleClient
{
    /**
     * Variable
     *
     * @var ClientInterface |
     */
    private $client;
    /**
     * Variable
     *
     * @var ResponseDataExtractor |
     */
    private $extractor;

    /**
     * GuzzleClient constructor.
     *
     * @param string                $host
     * @param array                 $headers
     * @param ResponseDataExtractor $extractor
     */
    public function __construct(string $host, array $headers, ResponseDataExtractor $extractor)
    {
        $this->client = new Client([
            'base_uri' => $host,
            'verify' => false,
            'headers' => $headers
        ]);

        $this->extractor = $extractor;
    }

    /**
     * @param array  $data
     * @param string $uri
     *
     * @return mixed
     */
    public function post(array $data, string $uri = '')
    {
        $response = $this->send(new Request('POST', $uri, [], json_encode($data)));
        return $this->extractor->extract($response);
    }

    /**
     * @param string $uri
     *
     * @return object
     */
    public function get(string $uri = '')
    {
        $response = $this->send(new Request('GET', $uri));
        return $this->extractor->extract($response);
    }


    /**
     * @param RequestInterface $request
     * @param array            $options
     *
     * @return ResponseInterface
     */
    private function send(RequestInterface $request, array $options = []): ResponseInterface
    {
        try {
            return $this->client->send($request, $options);
        } catch (GuzzleException $e) {
            return new Response();
        }
    }
}
