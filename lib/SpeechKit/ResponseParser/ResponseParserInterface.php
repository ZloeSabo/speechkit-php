<?php
/**
 * @author Evgeny Soynov <saboteur@saboteur.me>
 */

namespace SpeechKit\ResponseParser;


use SpeechKit\Response\ResponseInterface;

interface ResponseParserInterface
{
    public function parse(ResponseInterface $result);
} 