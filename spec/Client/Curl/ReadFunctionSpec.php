<?php

namespace spec\SpeechKit\Client\Curl;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Psr\Http\Message\StreamInterface;

class ReadFunctionSpec extends ObjectBehavior
{
    public function let(StreamInterface $stream)
    {
        $this->beConstructedWith($stream);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType('SpeechKit\Client\Curl\ReadFunction');
    }

    public function it_reads_from_wrapped_stream(StreamInterface $stream)
    {
        $stream->read(3)->willReturn('123');

        $this->read(null, null, 3)->shouldReturn('123');
    }
}
