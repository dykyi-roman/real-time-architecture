<?php

namespace App\Domain;


use App\Infrastructure\Centrifugo\Response\ResponseInterface;

/**
 * Interface CentrifugoInterface
 * @package Dykyi
 */
interface CentrifugoInterface
{
    /**
     * Send message into channel.
     *
     * @param string $channel
     * @param array  $data
     *
     * @return ResponseInterface
     */
    public function publish(string $channel, array $data = []): ResponseInterface;

    /**
     * Very similar to publish but allows to send the same data into many channels.
     *
     * @param array $channels
     * @param array $data
     *
     * @return ResponseInterface
     */
    public function broadcast(array $channels, array $data): ResponseInterface;

    /**
     * Get channel presence information (all clients currently subscribed on this channel).
     *
     * @param string $channel
     *
     * @return ResponseInterface
     */
    public function presence(string $channel): ResponseInterface;

    /**
     * Presence stats
     *
     * @param string $channel
     *
     * @return ResponseInterface
     */
    public function presenceStats(string $channel): ResponseInterface;

    /**
     * Get channel history information (list of last messages sent into channel)
     *
     * @param string $channel
     *
     * @return ResponseInterface
     */
    public function history(string $channel): ResponseInterface;

    /**
     * History remove
     *
     * @param string $channel
     *
     * @return ResponseInterface
     */
    public function historyRemove(string $channel): ResponseInterface;

    /**
     * Unsubscribe user from channel.
     *
     * @param string $channel
     * @param int    $userId
     *
     * @return ResponseInterface
     */
    public function unsubscribe(string $channel, int $userId): ResponseInterface;

    /**
     * Disconnect user by user ID.
     *
     * @param int $userId
     *
     * @return ResponseInterface
     */
    public function disconnect(int $userId): ResponseInterface;

    /**
     * Get channels information (list of currently active channels).
     *
     * @return ResponseInterface
     */
    public function channels(): ResponseInterface;

    /**
     * Get general info
     *
     * @return ResponseInterface
     */
    public function info(): ResponseInterface;
}
