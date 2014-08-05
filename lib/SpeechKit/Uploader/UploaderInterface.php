<?php
/**
 * Created by Evgeny Soynov <saboteur@saboteur.me> .
 */

namespace SpeechKit\Uploader;


use SpeechKit\SpeechContent\SpeechContentInterface;

interface UploaderInterface
{
    //TODO move this to uploader options interface
    const TOPIC_GENERAL = 'general';
    const TOPIC_MAPS = 'maps';
    const TOPIC_FREEFORM = 'freeform';
    const TOPIC_MUSIC = 'music';

    const LANG_RU = 'ru-RU';
    const LANG_TR = 'tr-TR';

    public function upload(SpeechContentInterface $speech);
    public function &options();
} 