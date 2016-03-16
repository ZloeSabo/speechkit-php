<?php

namespace spec\SpeechKit\Response;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class HypothesisSpec extends ObjectBehavior
{
    public function let()
    {
        $this->beConstructedWith(0.2, 'test');
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType('SpeechKit\Response\Hypothesis');
    }

    public function it_does_not_modify_given_data()
    {
        $this->getConfidence()->shouldReturn(0.2);
        $this->getContent()->shouldReturn('test');
    }
}
