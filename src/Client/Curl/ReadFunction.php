<?php

namespace SpeechKit\Client\Curl;

use Psr\Http\Message\StreamInterface;

/**
 * @author Evgeny Soynov<saboteur@saboteur.me>
 */
class ReadFunction
{
    /** @var StreamInterface */
    private $stream;

    /**
     * @param StreamInterface $stream
     */
    public function __construct(StreamInterface $stream)
    {
        $this->stream = $stream;
    }

    /**
     * @param int $unused1 not used
     * @param int $unused2 not used
     * @param int $length amount of data to send to server
     * @return string
     */
    public function read($unused1, $unused2, $length)
    {
        return $this->stream->read($length);
    }
}