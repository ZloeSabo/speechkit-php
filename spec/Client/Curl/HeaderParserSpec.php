<?php

namespace spec\SpeechKit\Client\Curl;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class HeaderParserSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('SpeechKit\Client\Curl\HeaderParser');
    }

    public function it_returns_length_of_processed_header()
    {
        $this->parseFunction(null, '123')->shouldReturn(3);
    }

    public function it_stores_status_info_when_header_contains_http_version()
    {
        $this->parseFunction(null, 'HTTP/1.1 505 HTTP Version not supported');
        $this->getStatusInfo()->shouldReturn([505, 'HTTP Version not supported']);
        $this->getHeaders()->shouldReturn([]);
    }

    public function it_stores_header_info_when_header_contains_colon()
    {
        $this->parseFunction(null, 'Date: Tue, 05 Apr 2016 20:01:24 GMT  ');
        $this->getStatusInfo()->shouldReturn([]);
        $this->getHeaders()->shouldReturn(['Date' => 'Tue, 05 Apr 2016 20:01:24 GMT']);
    }

    public function it_resets_stored_data()
    {
        $this->parseFunction(null, 'HTTP/1.1 505 HTTP Version not supported');
        $this->parseFunction(null, 'Date: Tue, 05 Apr 2016 20:01:24 GMT  ');

        $this->reset();

        $this->getStatusInfo()->shouldReturn([]);
        $this->getHeaders()->shouldReturn([]);
    }
}
