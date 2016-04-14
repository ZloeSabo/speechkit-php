<?php

namespace spec\SpeechKit\Client;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use SpeechKit\Client\ClientInterface;
use SpeechKit\Client\Curl\HeaderParser;
use SpeechKit\Client\Curl\OptionsGenerator;

class CurlSpec extends ObjectBehavior
{
    public function let(HeaderParser $headerParser, OptionsGenerator $optionsGenerator)
    {
        $this->beConstructedWith($headerParser, $optionsGenerator);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType('SpeechKit\Client\Curl');
    }

    public function it_is_client()
    {
        $this->shouldImplement('SpeechKit\Client\ClientInterface');
    }

    //TODO test upload somewhere
}
