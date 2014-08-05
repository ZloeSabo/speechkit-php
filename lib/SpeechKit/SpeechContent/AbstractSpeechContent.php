<?php
/**
 * Created by Evgeny Soynov <saboteur@saboteur.me> .
 */

namespace SpeechKit\SpeechContent;


class AbstractSpeechContent implements SpeechContentInterface
{
    public $contentType;

    public function getContentType()
    {
        return $this->contentType;
    }

    public function setContentType($type)
    {
        $this->contentType = $type;
    }
} 