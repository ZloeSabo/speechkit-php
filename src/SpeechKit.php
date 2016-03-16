<?php
/**
 * Created by Evgeny Soynov <saboteur@saboteur.me> .
 */

namespace SpeechKit;

use SpeechKit\Exception\SpeechKitException;
use SpeechKit\ResponseParser\ResponseParserInterface;
use SpeechKit\Speech\SpeechFactory;
use SpeechKit\Speech\SpeechInfoInterface;
use SpeechKit\Uploader\Curl as CurlUploader;
use SpeechKit\ResponseParser\SimpleXML as SimpleXMLParser;
use SpeechKit\Uploader\UploaderInterface;

//Uses uploader to upload data
//Uses parser to parse response
//Returns null if parsing failed

class SpeechKit
{
    protected $key;
    /** @var UploaderInterface */
    protected $uploader;
    protected $responseParser;


    public function __construct($key, UploaderInterface $uploader = null, ResponseParserInterface $responseParser = null)
    {
        $this->key = $key;
        $this->uploader = $uploader ?: new CurlUploader($key);
        $uploader->options()->setKey($this->key);

        $this->responseParser = $responseParser ?: new SimpleXMLParser();
    }

    public function recognize(SpeechInfoInterface $speech)
    {
        $response = $this->uploader->upload($speech);

        return $this->responseParser->parse($response);
    }
} 