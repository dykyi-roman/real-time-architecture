<?php

namespace App\Domain\Centrifugo\Response;

/**
 * Class ResponseResult
 */
final class ResponseResult implements ResponseInterface
{
    /**
     * Variable
     *
     * @var \stdClass |
     */
    private $result;

    /**
     * CentrifugoExcaption constructor.
     *
     * @param $result
     */
    public function __construct($result)
    {
        $this->result = $result;
    }
}