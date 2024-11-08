<?php

namespace App\Infrastructure\Centrifugo\Response;

/**
 * Class ResponseException
 */
final class ResponseException implements ResponseInterface
{
    /**
     * Variable
     *
     * @var int |
     */
    private $code;
    /**
     * Variable
     *
     * @var string |
     */
    private $message;

    /**
     * CentrifugoExcaption constructor.
     *
     * @param \stdClass $errorClass
     */
    public function __construct(\stdClass $errorClass)
    {
        $this->code = $errorClass->code;
        $this->message = $errorClass->message;
    }

    /**
     * @return int
     */
    public function getCode(): int
    {
        return $this->code;
    }

    /**
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }
}
