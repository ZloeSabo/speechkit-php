<?php

namespace SpeechKit\Uploader;

use Psr\Http\Message\ResponseInterface;
use SpeechKit\Speech\SpeechContentInterface;

/**
 * @author Evgeny Soynov<saboteur@saboteur.me>
 */
interface UploaderInterface
{
    /**
     * @param SpeechContentInterface $speech speech to recognize
     * @return ResponseInterface
     */
    public function upload(SpeechContentInterface $speech);
}