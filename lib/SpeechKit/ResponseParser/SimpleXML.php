<?php
/**
 * @author Evgeny Soynov <saboteur@saboteur.me>
 */

namespace SpeechKit\ResponseParser;


use SpeechKit\Response\ResponseInterface;

class SimpleXML implements ResponseParserInterface
{
    public function parse(ResponseInterface $result)
    {
        $xml = simplexml_load_string($result->getContent());

        if($xml->attributes()->success == '1') {
            $result = [];

            foreach($xml->variant as $variant) {
                $confidence = intval($variant->attributes()->confidence);
                $result[$confidence] = (string)$variant;
            }

            return $result;
        }

        return false;
    }
} 