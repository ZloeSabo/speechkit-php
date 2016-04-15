<?php

namespace SpeechKit\Speech;

/**
 * @author Evgeny Soynov<saboteur@saboteur.me>
 */
interface SpeechInfoInterface
{
    const CONTENT_SPEEX = 'audio/x-speex';
    const CONTENT_PCM_16B8K = 'audio/x-pcm;bit=16;rate=8000';
    const CONTENT_PCM_16B16K = 'audio/x-pcm;bit=16;rate=16000';
    const CONTENT_ALAW_13B8K = 'audio/x-alaw;bit=13;rate=8000';
    const CONTENT_WAV = 'audio/x-wav';
    const CONTENT_MP3 = 'audio/x-mpeg-3';

    const TOPIC_QUERIES = 'queries';
    const TOPIC_NOTES = 'notes';
    const TOPIC_DATES = 'dates';
    const TOPIC_NAMES = 'names';
    const TOPIC_NUMBERS = 'numbers';
    const TOPIC_BUYING = 'buying';
    const TOPIC_GENERAL = 'general';
    const TOPIC_MAPS = 'maps';
    const TOPIC_FREEFORM = 'freeform';
    const TOPIC_MUSIC = 'music';

    const LANG_RU = 'ru-RU';
    const LANG_TR = 'tr-TR';

    /**
     * @return string
     */
    public function getContentType();

    /**
     * @return string
     */
    public function getTopic();

    /**
     * @return string
     */
    public function getLang();

    /**
     * @return string
     */
    public function getUuid();
}