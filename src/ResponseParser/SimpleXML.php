<?php

namespace SpeechKit\ResponseParser;

use Psr\Http\Message\ResponseInterface;
use SpeechKit\Exception\SpeechKitException;
use SpeechKit\Response\HypothesesList;
use SpeechKit\Response\Hypothesis;

/**
 * @author Evgeny Soynov<saboteur@saboteur.me>
 */
class SimpleXML implements ResponseParserInterface
{
    const SUCCESSFUL_RESULT = 1;

    /**
     * Creates Hyphotesis list from given response which contains xml. 
     * Hyphotesis in list are in the order provided by api.
     * @param ResponseInterface $response
     * @return HypothesesList
     */
    public function parse(ResponseInterface $response)
    {
        $contents = $response->getBody()->getContents();
        $xml = simplexml_load_string($contents, 'SimpleXMLElement', LIBXML_NOERROR | LIBXML_NOWARNING);

        if (false === $xml instanceof \SimpleXMLElement) {
            throw new SpeechKitException(
                sprintf('Could not parse response contents: %s', $contents)
            );
        }

        if (self::SUCCESSFUL_RESULT !== (int)$xml->attributes()->success) {
            return new HypothesesList();
        }

        $result = new HypothesesList(count($xml->variant));
        $current = 0;
        foreach ($xml->variant as $variant) {
            $confidence = (float)$variant->attributes()->confidence;
            $result[$current] = new Hypothesis($confidence, (string)$variant);
            $current++;
        }

        return $result;
    }
} 