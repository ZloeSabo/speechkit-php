<?php
/**
 * Created by Evgeny Soynov <saboteur@saboteur.me> .
 */

namespace SpeechKit\Uploader;


use SpeechKit\SpeechContent\SpeechContentInterface;

abstract class AbstractUploader implements UploaderInterface
{
    protected $server = 'http://asr.yandex.net/asr_xml?';

    /** @var UploaderOptions */
    protected $options;

    public function &options()
    {
        $this->options = $this->options ?: new UploaderOptions();

        return $this->options;
    }

    abstract function upload(SpeechContentInterface $speech);

}