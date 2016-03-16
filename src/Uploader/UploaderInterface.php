<?php
/**
 * Created by Evgeny Soynov <saboteur@saboteur.me> .
 */

namespace SpeechKit\Uploader;

use Psr\Http\Message\ResponseInterface;
use SpeechKit\Speech\SpeechStreamInterface;

interface UploaderInterface
{
    /**
     * @param SpeechStreamInterface $speech speech to recognize
     * @return ResponseInterface
     */
    public function upload(SpeechStreamInterface $speech);
}