<?php

namespace SpeechKit\Uploader;

use GuzzleHttp\Psr7\Uri;
use Psr\Http\Message\UriInterface;
use SpeechKit\Speech\SpeechInfoInterface;

/**
 * @author Evgeny Soynov<saboteur@saboteur.me>
 */
class UrlGenerator
{
    /** @var string */
    private $base = 'http://asr.yandex.net/asr_xml';
    /** @var string */
    private $key;

    /**
     * @param string $key API key
     */
    public function __construct($key)
    {
        $this->key = $key;
    }

    /**
     * @param SpeechInfoInterface $speech source of url parameters
     * @return UriInterface
     */
    public function generate(SpeechInfoInterface $speech)
    {
        $query = http_build_query([
            'uuid'  => $speech->getUuid(),
            'key'   => $this->key,
            'topic' => $speech->getTopic(),
            'lang'  => $speech->getLang(),
        ]);
        $request = new Uri($this->base);

        return $request->withQuery($query);
    }
}