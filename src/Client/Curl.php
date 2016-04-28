<?php

namespace SpeechKit\Client;

use GuzzleHttp\Psr7\Response;
use Psr\Http\Message\RequestInterface;
use SpeechKit\Client\Curl\HeaderParser;
use SpeechKit\Client\Curl\OptionsGenerator;
use SpeechKit\Exception\SpeechKitException;

/**
 * @author Evgeny Soynov<saboteur@saboteur.me>
 */
class Curl implements ClientInterface
{
    /** @var OptionsGenerator */
    private $optionsGenerator;
    /** @var HeaderParser */
    private $headerParser;

    /**
     * @param HeaderParser|null $headerParser
     * @param OptionsGenerator|null $generator
     */
    public function __construct(HeaderParser $headerParser = null, OptionsGenerator $generator = null)
    {
        $this->headerParser = $headerParser ?: new HeaderParser();
        $this->optionsGenerator = $generator ?: new OptionsGenerator($this->headerParser);
    }

    /**
     * {@inheritdoc}
     */
    public function upload(RequestInterface $request)
    {
        $this->headerParser->reset();

        $uri = $request->getUri();

        $ch = curl_init((string)$uri);

        $options = $this->optionsGenerator->generate($request);
        curl_setopt_array($ch, $options);

        $body = curl_exec($ch);
        if (0 !== curl_errno($ch)) {
            throw new SpeechKitException(curl_error($ch), curl_errno($ch));
        }
        list($status, $reason) = $this->headerParser->getStatusInfo();
        $headers = $this->headerParser->getHeaders();
        $body = \GuzzleHttp\Psr7\stream_for($body);

        return new Response($status, $headers, $body, '1.1', $reason);
    }
}