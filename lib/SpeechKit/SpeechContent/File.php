<?php
/**
 * Created by Evgeny Soynov <saboteur@saboteur.me> .
 */

namespace SpeechKit\SpeechContent;


class File extends AbstractSpeechContent implements SpeechStreamInterface, SpeechFileInterface
{
    private $file;

    public function __construct($file)
    {
        $this->file = $file;
        $this->contentType = self::CONTENT_MP3; //TODO type guessing solution
    }

    public function getData()
    {
        return file_get_contents($this->file);
    }

    public function getReadFunction()
    {
        $stream = fopen($this->file, 'r');

        return function($ch, $fd, $length) use ($stream) {
            return fread($stream, $length) ?: '';
        };
    }
} 