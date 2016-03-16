<?php
/**
 * Created by Evgeny Soynov <saboteur@saboteur.me> .
 */

namespace SpeechKit\Speech;


class File extends AbstractSpeechContent
{
    /**
     * @param string $path file with speech to recognize
     */
    public function __construct($path)
    {
        $this->uuid = bin2hex(openssl_random_pseudo_bytes(16));
        parent::__construct(fopen($path, 'r+'));
    }
} 