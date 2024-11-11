<?php

namespace App\Infrastructure\GuzzleClient\DataExtractor;

use App\Infrastructure\GuzzleClient\Exception\ClientException;
use Psr\Http\Message\ResponseInterface;

final class ResponseDataExtractor implements ResponseDataInterface
{
    public function extract(ResponseInterface $response)
    {
        $responseBody = $response->getBody()->getContents();
        $responseBody = rtrim($responseBody);
        $rawDecoded = json_decode($responseBody, true);
        if ($rawDecoded === null) {
            $oneLineResponseBody = str_replace("\n", '\n', $responseBody);
            throw new ClientException(sprintf("Can't decode response: %s", $oneLineResponseBody));
        }

        return $rawDecoded;
    }
}
