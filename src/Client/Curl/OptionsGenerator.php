<?php

namespace SpeechKit\Client\Curl;

use Psr\Http\Message\RequestInterface;

/**
 * @author Evgeny Soynov<saboteur@saboteur.me>
 */
class OptionsGenerator
{
    /** @var HeaderParser */
    private $headerParser;
    /** @var HeaderGenerator */
    private $headerGenerator;
    /** @var ReadFunctionFactory */
    private $readFunctionFactory;

    /**
     * @param HeaderParser|null $headerParser
     * @param HeaderGenerator|null $headerGenerator
     * @param ReadFunctionFactory|null $readFunctionFactory
     */
    public function __construct(
        HeaderParser $headerParser = null,
        HeaderGenerator $headerGenerator = null,
        ReadFunctionFactory $readFunctionFactory = null
    ) {
        $this->headerParser = $headerParser ?: new HeaderParser();
        $this->headerGenerator = $headerGenerator ?: new HeaderGenerator();
        $this->readFunctionFactory = $readFunctionFactory ?: new ReadFunctionFactory();
    }

    /**
     * Generates options to make multipart upload of given request
     * @param RequestInterface $request subject to options generation
     * @return array
     */
    public function generate(RequestInterface $request)
    {
        $readFunction = $this->readFunctionFactory->create($request->getBody());

        return [
            CURLOPT_UPLOAD         => true,
            CURLOPT_POST           => true,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_READFUNCTION   => [$readFunction, 'read'],
            CURLOPT_HEADERFUNCTION => [$this->headerParser, 'parseFunction'],
            CURLOPT_HTTPHEADER     => $this->headerGenerator->generate($request)
        ];
    }
}