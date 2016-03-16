<?php

namespace spec\SpeechKit\Client\Curl;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\StreamInterface;
use SpeechKit\Client\Curl\HeaderGenerator;
use SpeechKit\Client\Curl\HeaderParser;
use SpeechKit\Client\Curl\ReadFunction;
use SpeechKit\Client\Curl\ReadFunctionFactory;

class OptionsGeneratorSpec extends ObjectBehavior
{
    public function let(HeaderParser $headerParser, HeaderGenerator $headerGenerator, ReadFunctionFactory $readFunctionFactory)
    {
        $this->beConstructedWith($headerParser, $headerGenerator, $readFunctionFactory);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType('SpeechKit\Client\Curl\OptionsGenerator');
    }

    public function it_returns_array_of_options(RequestInterface $request, StreamInterface $body)
    {
        $request->getBody()->willReturn($body);

        $this->generate($request)->shouldBeArray();
    }

    public function it_sets_static_options(RequestInterface $request, StreamInterface $body)
    {
        $request->getBody()->willReturn($body);

        $this->generate($request)->shouldHaveKeyWithValue(CURLOPT_UPLOAD, true);
        $this->generate($request)->shouldHaveKeyWithValue(CURLOPT_POST, true);
        $this->generate($request)->shouldHaveKeyWithValue(CURLOPT_RETURNTRANSFER, true);
    }

    public function it_generates_headers_using_generator(RequestInterface $request, StreamInterface $body, HeaderGenerator $headerGenerator)
    {
        $request->getBody()->willReturn($body);
        $headerGenerator->generate($request)->willReturn(['generated', 'headers']);

        $this->generate($request)->shouldHaveKeyWithValue(CURLOPT_HTTPHEADER, ['generated', 'headers']);
    }

    public function it_uses_parse_function_from_header_parser(RequestInterface $request, StreamInterface $body, HeaderParser $headerParser)
    {
        $request->getBody()->willReturn($body);

        $this->generate($request)->shouldHaveKeyWithValue(CURLOPT_HEADERFUNCTION, [$headerParser, 'parseFunction']);
    }

    public function it_creates_read_function_using_factory(RequestInterface $request, StreamInterface $body, ReadFunctionFactory $readFunctionFactory, ReadFunction $readFunction)
    {
        $request->getBody()->willReturn($body);
        $readFunctionFactory->create($body)->willReturn($readFunction);

        $this->generate($request)->shouldHaveKeyWithValue(CURLOPT_READFUNCTION, [$readFunction, 'read']);
    }
}
