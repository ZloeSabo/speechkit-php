<?php

namespace SpeechKit\Client\Curl;

use Psr\Http\Message\StreamInterface;

/**
 * @author Evgeny Soynov<saboteur@saboteur.me>
 */
class ReadFunctionFactory
{
    /**
     * Creates ReadFunction instance for given stream
     * @param StreamInterface $stream
     * @return ReadFunction
     */
    public function create(StreamInterface $stream)
    {
        return new ReadFunction($stream);
    }
}