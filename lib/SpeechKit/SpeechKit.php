<?php
/**
 * Created by Evgeny Soynov <saboteur@saboteur.me> .
 */

namespace SpeechKit;

use SpeechKit\Exception\SpeechKitException;
use SpeechKit\ResponseParser\ResponseParserInterface;
use SpeechKit\SpeechContent\SpeechFactory;
use SpeechKit\SpeechContent\SpeechContentInterface;
use SpeechKit\Uploader\Curl as CurlUploader;
use SpeechKit\ResponseParser\SimpleXML as SimpleXMLParser;
use SpeechKit\Uploader\UploaderInterface;

class SpeechKit
{
    protected $key;
    /** @var UploaderInterface */
    protected $uploader;
    protected $responseParser;
    protected $response;
    protected $speech;

    /**
     * @param string $key
     */
    public function __construct($key)
    {
        $this->key = $key;
    }

    public function setUploader(UploaderInterface $uploader)
    {
        $uploader->options()->setKey($this->key);

        $this->uploader = $uploader;

        return $this;
    }

    public function setResponseParser(ResponseParserInterface $parser)
    {
        $this->responseParser = $parser;

        return $this;
    }

    public function getResponse()
    {
        return $this->response;
    }

    public function recognize($data)
    {
        if(empty($this->uploader)) {
            $this->uploader = new CurlUploader();
            $this->uploader->options()->setKey($this->key);
        }

        if(empty($this->responseParser)) {
            $this->responseParser = new SimpleXMLParser();
        }

        if(!$data instanceof SpeechContentInterface) {
            $data = SpeechFactory::fromData($data);
        }

        $this->response = $response = $this->uploader->upload($data);

        $result = $this->responseParser->parse($response);

        return $result;
    }
} 