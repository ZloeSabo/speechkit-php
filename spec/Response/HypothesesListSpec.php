<?php

namespace spec\SpeechKit\Response;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class HypothesesListSpec extends ObjectBehavior
{
    public function let()
    {
        $this->beConstructedWith(1);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType('SpeechKit\Response\HypothesesList');
    }

    public function it_fails_when_adding_non_hyphotesis()
    {
        $this->shouldThrow('\InvalidArgumentException')->duringOffsetSet(0, new \stdClass());
    }
}
