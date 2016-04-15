<?php

namespace SpeechKit\ResponseParser;

use Psr\Http\Message\ResponseInterface;
use SpeechKit\Response\HypothesesList;

/**
 * @author Evgeny Soynov<saboteur@saboteur.me>
 */
interface ResponseParserInterface
{
    /**
     * Parse xml inside of response from api
     * @param ResponseInterface $result
     * @return HypothesesList
     */
    public function parse(ResponseInterface $result);
} 