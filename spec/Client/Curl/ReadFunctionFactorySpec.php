<?php

namespace spec\SpeechKit\Client\Curl;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Psr\Http\Message\StreamInterface;

class ReadFunctionFactorySpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('SpeechKit\Client\Curl\ReadFunctionFactory');
    }

    public function it_creates_read_function_for_given_stream(StreamInterface $stream)
    {
        $this->create($stream)->shouldReturnAnInstanceOf('SpeechKit\Client\Curl\ReadFunction');
    }
}
