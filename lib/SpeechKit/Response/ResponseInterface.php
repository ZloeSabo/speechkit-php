<?php
/**
 * @author Evgeny Soynov <saboteur@saboteur.me>
 */

namespace SpeechKit\Response;


interface ResponseInterface
{
    public function getCode();
    public function setCode($code);
    public function getContent();
    public function setContent($content);
    public function getYandexMeta();
} 