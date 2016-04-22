<?php

namespace spec\SpeechKit;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Psr\Http\Message\ResponseInterface;
use SpeechKit\ResponseParser\ResponseParserInterface;
use SpeechKit\Speech\SpeechContentInterface;
use SpeechKit\Uploader\UploaderInterface;

class SpeechKitSpec extends ObjectBehavior
{
    private $key = 'TEST';

    public function let(UploaderInterface $uploader, ResponseParserInterface $responseParser)
    {
        $this->beConstructedWith($this->key, $uploader, $responseParser);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType('SpeechKit\SpeechKit');
    }

    public function it_processes_speech_recognition_with_speechkit_api(
        SpeechContentInterface $speech,
        ResponseInterface $response,
        UploaderInterface $uploader,
        ResponseParserInterface $responseParser
    ) {
        $uploader->upload($speech)->willReturn($response);
        $responseParser->parse($response)->willReturn('hyphoteses list');

        $this->recognize($speech)->shouldReturn('hyphoteses list');
    }

    public function it_is_initializable_with_only_key()
    {
        $this->beConstructedWith($this->key);
        $this->shouldHaveType('SpeechKit\SpeechKit');
    }
}
