<?php
/**
 * @author Evgeny Soynov <saboteur@saboteur.me>
 */

namespace SpeechKit\Response;


class Curl extends AbstractResponse
{
    public function headerParser($curlHandle, $headerLine) {

        if (stripos($headerLine, 'HTTP/1.1') !== false) {
            list(,$code, $status) = explode(' ', $headerLine);
            $this->code = intval($code);

        } elseif (stripos($headerLine, ':') !== false) {
            list($headerName, $headerValue) = explode(':', $headerLine, 2);
            $this->headers[$headerName] = trim($headerValue);
        }

        return strlen($headerLine);
    }
}