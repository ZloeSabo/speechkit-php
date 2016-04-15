<?php

namespace SpeechKit\Speech;

use Psr\Http\Message\StreamInterface;

/**
 * @author Evgeny Soynov<saboteur@saboteur.me>
 */
interface SpeechContentInterface extends SpeechInfoInterface
{
    /**
     * @return StreamInterface
     */
    public function getStream();
}