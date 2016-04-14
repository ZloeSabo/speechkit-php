<?php

namespace spec\SpeechKit\Uploader;

use GuzzleHttp\Psr7\Uri;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use SpeechKit\Speech\SpeechInfoInterface;

class UrlGeneratorSpec extends ObjectBehavior
{
    const KEY = 'super_secret_key';

    public function let()
    {
        $this->beConstructedWith(self::KEY);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType('SpeechKit\Uploader\UrlGenerator');
    }

    public function it_returns_uri_instance(SpeechInfoInterface $speech)
    {
        $this->generate($speech)->shouldReturnAnInstanceOf('GuzzleHttp\Psr7\Uri');
    }

    public function it_generates_valid_url(SpeechInfoInterface $speech)
    {
        $speech->getUuid()->willReturn('12345');
        $speech->getLang()->willReturn('ru-RU');
        $speech->getTopic()->willReturn('notes');

        //TODO update this spec to use uri functions
        $this->generate($speech)->shouldHaveUrlParams([
            'url'   => 'http://asr.yandex.net/asr_xml',
            'uuid'  => '12345',
            'lang'  => 'ru-RU',
            'topic' => 'notes',
            'key'   => self::KEY
        ]);
    }

    public function getMatchers()
    {
        return [
            'haveUrlParams' => function ($subject, $expectation) {
                $urlInfo = parse_url($subject);
                $actualUrl = sprintf('%s://%s%s', $urlInfo['scheme'], $urlInfo['host'], $urlInfo['path']);
                if($expectation['url'] !== $actualUrl) {
                    return false;
                }
                unset($expectation['url']);
                parse_str($urlInfo['query'], $actual);

                return $actual == $expectation;
            }
        ];
    }
}