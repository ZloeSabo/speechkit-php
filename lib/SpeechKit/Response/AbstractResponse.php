<?php
/**
 * @author Evgeny Soynov <saboteur@saboteur.me>
 */

namespace SpeechKit\Response;


class AbstractResponse implements ResponseInterface
{
    protected $headers = [];
    protected $content = "";
    protected $code = -1;

    protected $yandexMeta = [];

    /**
     * @return int
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @param int $code
     * @return Curl
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param string $content
     * @return Curl
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * @return array
     */
    public function getHeaders()
    {
        return $this->headers;
    }

    /**
     * @return array
     */
    public function getYandexMeta()
    {
        if(!empty($this->headers) && empty($this->yandexMeta)) {
            $this->yandexMeta = [
                'Date' => $this->headers['Date'],
                'Server' => $this->headers['Server'],
                'Finish' => $this->headers['Finish'],
                'X-YaRequestId' => $this->headers['X-YaRequestId'],
                'X-YaUuid' => $this->headers['X-YaUuid']
            ];
        }

        return $this->yandexMeta;
    }
} 