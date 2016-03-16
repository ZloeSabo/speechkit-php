<?php

namespace SpeechKit\Client\Curl;

use Psr\Http\Message\RequestInterface;

/**
 * @author Evgeny Soynov<saboteur@saboteur.me>
 */
class HeaderGenerator
{
    const CHUNKED_TRANSFER_HEADER = 'Transfer-Encoding: chunked';

    /**
     * Generates headers for given request
     * @param RequestInterface $request
     * @return array
     */
    public function generate(RequestInterface $request)
    {
        $headers = [];
        foreach ($request->getHeaders() as $name => $values) {
            $headers[] = sprintf('%s: %s', $name, implode(', ', $values));
        }
        $headers[] = self::CHUNKED_TRANSFER_HEADER;

        return $headers;
    }
}