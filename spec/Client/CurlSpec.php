<?php

namespace spec\SpeechKit\Client;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Psr\Http\Message\RequestInterface;
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

    public function it_uploads_given_request(RequestInterface $request, HeaderParser $headerParser, OptionsGenerator $optionsGenerator)
    {
        $request->getUri()->willReturn('http://example.com');
        $headerParser->reset()->willReturn(null);
        $headerParser->getHeaders()->willReturn(['headers']);
        $headerParser->getStatusInfo()->willReturn(10, 'OKAY');
        $optionsGenerator->generate($request)->willReturn([CURLOPT_RETURNTRANSFER => true]);

        $this->upload($request)->shouldReturnAnInstanceOf('Psr\Http\Message\ResponseInterface');
    }

    public function it_throws_when_connnection_error_happens(RequestInterface $request, OptionsGenerator $optionsGenerator)
    {
        $request->getUri()->willReturn('http://localhost:999999');
        $optionsGenerator->generate($request)->willReturn([CURLOPT_RETURNTRANSFER => true]);

        $this->shouldThrow('SpeechKit\Exception\SpeechKitException')->duringUpload($request);
    }
}
