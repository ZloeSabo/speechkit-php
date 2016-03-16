<?php

namespace SpeechKit\Client;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

/**
 * @author Evgeny Soynov<saboteur@saboteur.me>
 */
interface ClientInterface
{
    /**
     * @param RequestInterface $request
     * @throws \SpeechKit\Exception\SpeechKitException
     * @return ResponseInterface
     */
    public function upload(RequestInterface $request);
}