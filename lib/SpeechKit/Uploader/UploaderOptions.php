<?php
/**
 * Created by Evgeny Soynov <saboteur@saboteur.me> .
 */

namespace SpeechKit\Uploader;


class UploaderOptions
{
    private $storage = [];

    public function __construct()
    {
        //TODO make this without openssl
        $this->storage['uuid'] = bin2hex(openssl_random_pseudo_bytes(16));
        $this->storage['topic'] = UploaderInterface::TOPIC_GENERAL;
    }

    public function __call($name, $arguments)
    {
        if(substr($name, 0, 3) === 'set' && count($arguments) == 1) {
            $property = substr($name, 3);
            $property = strtolower($property);

            $this->storage[$property] = $arguments[0];
        }

        return $this;
    }

    public function getEncoded()
    {
        return http_build_query($this->storage);
    }
} 