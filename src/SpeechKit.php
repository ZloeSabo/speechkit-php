<?php

namespace SpeechKit;

use SpeechKit\Client\Curl;
use SpeechKit\Response\HypothesesList;
use SpeechKit\ResponseParser\ResponseParserInterface;
use SpeechKit\ResponseParser\SimpleXML;
use SpeechKit\Speech\SpeechContentInterface;
use SpeechKit\Uploader\Uploader;
use SpeechKit\Uploader\UploaderInterface;
use SpeechKit\Uploader\UrlGenerator;

/**
 * @author Evgeny Soynov<saboteur@saboteur.me>
 */
class SpeechKit
{
    /** @var UploaderInterface */
    protected $uploader;
    /** @var ResponseParserInterface */
    protected $responseParser;

    /**
     * @param string $key SpeechKit API key
     * @param UploaderInterface|null $uploader uploader used for uploading speech content
     * @param ResponseParserInterface|null $responseParser api xml response parser
     */
    public function __construct(
        $key,
        UploaderInterface $uploader = null,
        ResponseParserInterface $responseParser = null
    ) {
        $this->uploader = $uploader ?: $this->createUploader($key);
        $this->responseParser = $responseParser ?: new SimpleXML();
    }

    /**
     * Runs recognition of given speech. Returns list of hyphoteses in same order as SpeechKit API returned.
     * @param SpeechContentInterface $speech
     * @return HypothesesList
     */
    public function recognize(SpeechContentInterface $speech)
    {
        $response = $this->uploader->upload($speech);

        return $this->responseParser->parse($response);
    }

    /**
     * Creates new content uploader if none explicitly given
     * @param string $key API key
     * @return Uploader
     */
    private function createUploader($key)
    {
        $urlGenerator = new UrlGenerator($key);
        $client = new Curl();
        
        return new Uploader($urlGenerator, $client);
    }
} 