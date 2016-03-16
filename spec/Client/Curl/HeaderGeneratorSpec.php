<?php

namespace spec\SpeechKit\Client\Curl;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Psr\Http\Message\RequestInterface;

class HeaderGeneratorSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('SpeechKit\Client\Curl\HeaderGenerator');
    }

    public function it_combines_multiple_header_values_to_one(RequestInterface $request)
    {
        $request->getHeaders()->willReturn(['TestHeader' => ['Value1', 'Value2']]);

        $this->generate($request)->shouldContain('TestHeader: Value1, Value2');
    }

    public function it_adds_transfer_encoding_header(RequestInterface $request)
    {
        $request->getHeaders()->willReturn([]);

        $this->generate($request)->shouldContain('Transfer-Encoding: chunked');
    }
}
