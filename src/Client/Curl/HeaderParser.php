<?php

namespace SpeechKit\Client\Curl;

/**
 * @author Evgeny Soynov<saboteur@saboteur.me>
 */
class HeaderParser
{
    const HTTP_VERSION = 'HTTP/';
    const HTTP_STATUS_DELIMITER = ' ';
    const HEADER_DELIMITER = ':';

    /** @var array */
    private $statusInfo = [];
    /** @var array */
    private $headers = [];

    /**
     * Reset parser
     */
    public function reset()
    {
        $this->statusInfo = [];
        $this->headers = [];
    }

    /**
     * Get status code and its text description
     * @return array
     */
    public function getStatusInfo()
    {
        return $this->statusInfo;
    }

    /**
     * Get parsed headers
     * @return array
     */
    public function getHeaders()
    {
        return $this->headers;
    }

    /**
     * @param int $_ not used
     * @param string $headerLine header to parse
     * @return int length of the parsed header line
     */
    public function parseFunction($_, $headerLine)
    {
        if (false !== stripos($headerLine, self::HTTP_VERSION)) {
            list(, $code, $status) = explode(self::HTTP_STATUS_DELIMITER, $headerLine, 3);
            $this->statusInfo = [(int)$code, $status];
        } elseif (false !== stripos($headerLine, self::HEADER_DELIMITER)) {
            list($headerName, $headerValue) = explode(self::HEADER_DELIMITER, $headerLine, 2);
            $this->headers[$headerName] = trim($headerValue);
        }

        return strlen($headerLine);
    }
}