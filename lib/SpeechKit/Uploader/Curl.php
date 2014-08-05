<?php
/**
 * Created by Evgeny Soynov <saboteur@saboteur.me> .
 */

namespace SpeechKit\Uploader;


use SpeechKit\SpeechContent\SpeechContentInterface;
use SpeechKit\SpeechContent\SpeechFileInterface;
use SpeechKit\SpeechContent\SpeechStreamInterface;

class Curl extends AbstractUploader
{
    public function upload(SpeechContentInterface $speech)
    {
        $url = sprintf(
            '%s%s',
            $this->server,
            $this->options()->getEncoded()
        );
//        var_dump($url); exit;

        $ch = curl_init($url);

        $headers = [sprintf('Content-Type: %s', $speech->getContentType())];

        curl_setopt_array($ch, [
            CURLOPT_UPLOAD => true,
            CURLOPT_POST => true
        ]);

        if($speech instanceof SpeechStreamInterface) {
            $headers += ['Transfer-Encoding: chunked'];
            curl_setopt($ch, CURLOPT_READFUNCTION, $speech->getReadFunction());
        } elseif ($speech instanceof SpeechFileInterface) {
            curl_setopt($ch, CURLOPT_POSTFIELDS, $speech->getData());
        }

        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $result = curl_exec($ch);

        curl_close($ch);

        return $result;
    }
} 