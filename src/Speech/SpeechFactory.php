<?php
/**
 * Created by Evgeny Soynov <saboteur@saboteur.me> .
 */

namespace SpeechKit\Speech;


class SpeechFactory
{
    public static function fromData($data)
    {
        if(@is_file($data)) {
            return new File($data);
        } else {
            return new RawData($data);
        }
    }
}
