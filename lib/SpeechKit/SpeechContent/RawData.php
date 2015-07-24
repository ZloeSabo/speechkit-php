<?php
/**
 * Created by Evgeny Soynov <saboteur@saboteur.me> .
 */

namespace SpeechKit\SpeechContent;

class RawData extends AbstractSpeechContent implements SpeechStreamInterface, SpeechFileInterface
{
    private $data;
    private $offset = 0;

    public function __construct($data)
    {
        $this->data = $data;
        $this->contentType = self::CONTENT_MP3;
    }

    public function getData()
    {
        return $this->data;
    }

    public function getReadFunction()
    {
        return function($ch, $fd, $length) {
            $result = substr($this->data, $this->offset, $length);
            $this->offset += $length;

            return $result;
        };
    }
} 