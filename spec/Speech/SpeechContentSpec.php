<?php

namespace spec\SpeechKit\Speech;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use SpeechKit\Speech\SpeechContentInterface;

class SpeechContentSpec extends ObjectBehavior
{
    private $path = 'php://memory';

    public function let()
    {
        $this->beConstructedWith($this->path);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType('SpeechKit\Speech\SpeechContent');
    }

    public function it_has_methods_to_get_stream_and_its_meta()
    {
        $this->shouldImplement('SpeechKit\Speech\SpeechContentInterface');
    }

    public function it_has_default_parameters()
    {
        $this->getContentType()->shouldReturn('audio/x-mpeg-3');
        $this->getTopic()->shouldReturn('general');
        $this->getLang()->shouldReturn('ru-RU');
        $this->getUuid()->shouldMatch('/^\w{32}$/');
    }
}
