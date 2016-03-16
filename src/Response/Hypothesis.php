<?php

namespace SpeechKit\Response;

/**
 * @author Evgeny Soynov<saboteur@saboteur.me>
 */
class Hypothesis
{
    /** @var float */
    private $confidence;
    /** @var string */
    private $content;

    /**
     * @param float $confidence
     * @param string $content
     */
    public function __construct($confidence, $content)
    {
        $this->confidence = $confidence;
        $this->content = $content;
    }

    /**
     * @return float
     */
    public function getConfidence()
    {
        return $this->confidence;
    }

    /**
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }
}