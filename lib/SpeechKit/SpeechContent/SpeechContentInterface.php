<?php
/**
 * Created by Evgeny Soynov <saboteur@saboteur.me> .
 */

namespace SpeechKit\SpeechContent;


interface SpeechContentInterface
{
    const CONTENT_SPEEX = 'audio/x-speex';
    const CONTENT_PCM_16B8K = 'audio/x-pcm;bit=16;rate=8000';
    const CONTENT_PCM_16B16K = 'audio/x-pcm;bit=16;rate=16000';
    const CONTENT_ALAW_13B8K = 'audio/x-alaw;bit=13;rate=8000';
    const CONTENT_WAV = 'audio/x-wav';
    const CONTENT_MP3 = 'audio/x-mpeg-3';

    public function getContentType();
    public function setContentType($type);
}