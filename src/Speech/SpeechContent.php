<?php

namespace SpeechKit\Speech;

use Psr\Http\Message\StreamInterface;

/**
 * @author Evgeny Soynov<saboteur@saboteur.me>
 */
class SpeechContent implements SpeechContentInterface
{
    /** @var string */
    protected $contentType = SpeechInfoInterface::CONTENT_MP3;
    /** @var string */
    protected $topic = SpeechInfoInterface::TOPIC_GENERAL;
    /** @var string */
    protected $lang = SpeechInfoInterface::LANG_RU;
    /** @var string */
    protected $uuid;
    /** @var StreamInterface */
    protected $stream;

    /**
     * @param mixed $stream source of uploaded stream
     */
    public function __construct($stream)
    {
        $this->stream = \GuzzleHttp\Psr7\stream_for($stream);
        $this->uuid = bin2hex(openssl_random_pseudo_bytes(16));
    }

    /**
     * {@inheritdoc}
     */
    public function getContentType()
    {
        return $this->contentType;
    }

    /**
     * @param string $type sets content type of current speech stream
     */
    public function setContentType($type)
    {
        $this->contentType = $type;
    }

    /**
     * {@inheritdoc}
     */
    public function getTopic()
    {
        return $this->topic;
    }

    /**
     * @param string $topic sets topic of current speech stream
     */
    public function setTopic($topic)
    {
        $this->topic = $topic;
    }

    /**
     * {@inheritdoc}
     */
    public function getLang()
    {
        return $this->lang;
    }

    /**
     * @param string $lang sets language of current speech stream
     */
    public function setLang($lang)
    {
        $this->lang = $lang;
    }

    /**
     * {@inheritdoc}
     */
    public function getUuid()
    {
        return $this->uuid;
    }

    /**
     * @param string $uuid sets uuid of current speech stream
     */
    public function setUuid($uuid)
    {
        $this->uuid = $uuid;
    }

    /**
     * {@inheritdoc}
     */
    public function getStream()
    {
        return $this->stream;
    }
} 