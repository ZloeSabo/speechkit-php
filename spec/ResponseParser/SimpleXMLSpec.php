<?php

namespace spec\SpeechKit\ResponseParser;

use PhpSpec\Exception\Example\FailureException;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;
use SpeechKit\Response\HypothesesList;
use SpeechKit\Response\Hypothesis;

class SimpleXMLSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('SpeechKit\ResponseParser\SimpleXML');
    }
    
    public function it_has_parse_function()
    {
        $this->shouldImplement('SpeechKit\ResponseParser\ResponseParserInterface');
    }

    public function it_throws_exception_when_given_malformed_xml(ResponseInterface $response, StreamInterface $body)
    {
        $response->getBody()->willReturn($body);
        $body->getContents()->willReturn('DEADBEEF');
        $this->shouldThrow('\SpeechKit\Exception\SpeechKitException')->duringParse($response);
    }

    public function it_returns_hyphoteses_list(ResponseInterface $response, StreamInterface $body)
    {
        $xml=<<<XML
<?xml version="1.0" encoding="utf-8"?>
<recognitionResults success="1">
	<variant confidence="0.84">Dead beef</variant>
	<variant confidence="0.5">Something else</variant>
</recognitionResults>
XML;
        $response->getBody()->willReturn($body);
        $body->getContents()->willReturn($xml);

        $this->parse($response)->shouldReturnAnInstanceOf('SpeechKit\Response\HypothesesList');
        $this->parse($response)->shouldHaveHaveHyphotesis(0, 0.84, 'Dead beef');
        $this->parse($response)->shouldHaveHaveHyphotesis(1, 0.5, 'Something else');
    }

    public function it_returns_empty_list_when_recognition_failed(ResponseInterface $response, StreamInterface $body)
    {
        $xml=<<<XML
<?xml version="1.0" encoding="utf-8"?>
<recognitionResults success="0"/>
XML;
        $response->getBody()->willReturn($body);
        $body->getContents()->willReturn($xml);

        $this->parse($response)->shouldReturnAnInstanceOf('SpeechKit\Response\HypothesesList');
        $this->parse($response)->shouldHaveCount(0);
    }

    public function getMatchers()
    {
        return [
            'haveHaveHyphotesis' => function ($subject, $key, $confidence, $content) {
                if (!isset($subject[$key])) {
                    throw new FailureException(sprintf(
                        'Key "%s" does not exist in subject "%s".',
                        $key, get_class($subject)
                    ));
                }
                $checked = $subject[$key];
                if(false === $checked instanceof Hypothesis) {
                    throw new FailureException(sprintf(
                        'Key "%s" in subject "%s" is hot hypothesis.',
                        $key, get_class($subject)
                    ));
                }

                /** @var Hypothesis $checked */
                return $confidence === $checked->getConfidence()
                    && $content === $checked->getContent()
                    ;
            }
        ];
    }
}
