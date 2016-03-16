<?php
/**
 * @author Evgeny Soynov <saboteur@saboteur.me>
 */

namespace SpeechKit\ResponseParser;

use Psr\Http\Message\ResponseInterface;

interface ResponseParserInterface
{
    public function parse(ResponseInterface $result);
} 