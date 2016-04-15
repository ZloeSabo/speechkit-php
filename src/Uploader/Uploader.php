<?php

namespace SpeechKit\Uploader;

use GuzzleHttp\Psr7\Request;
use SpeechKit\Client\ClientInterface;
use SpeechKit\Speech\SpeechContentInterface;

/**
 * @author Evgeny Soynov<saboteur@saboteur.me>
 */
class Uploader implements UploaderInterface
{
    /** @var UrlGenerator */
    private $urlGenerator;
    /** @var ClientInterface */
    private $client;

    /**
     * @param UrlGenerator $generator url generator
     * @param ClientInterface $client client used for recognition content uploading
     */
    public function __construct(UrlGenerator $generator, ClientInterface $client)
    {
        $this->urlGenerator = $generator;
        $this->client = $client;
    }

    /**
     * {@inheritdoc}
     * @throws \InvalidArgumentException
     */
    public function upload(SpeechContentInterface $speech)
    {
        $headers = ['Content-Type' => $speech->getContentType()];
        $uri = $this->urlGenerator->generate($speech);

        $request = new Request('POST', $uri, $headers, $speech->getStream());

        return $this->client->upload($request);
    }
}