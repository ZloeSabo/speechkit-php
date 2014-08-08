<?php
/**
 * Created by Evgeny Soynov <saboteur@saboteur.me> .
 */

namespace SpeechKit\Uploader;


use SpeechKit\Response\Curl as CurlResponse;
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

        $ch = curl_init($url);

        $headers = [sprintf('Content-Type: %s', $speech->getContentType())];

        curl_setopt_array($ch, [
            CURLOPT_UPLOAD => true,
            CURLOPT_POST => true,
            CURLOPT_RETURNTRANSFER => true
        ]);

        if($speech instanceof SpeechStreamInterface) {
            $headers += ['Transfer-Encoding: chunked'];
            curl_setopt($ch, CURLOPT_READFUNCTION, $speech->getReadFunction());
        } elseif ($speech instanceof SpeechFileInterface) {
            curl_setopt($ch, CURLOPT_POSTFIELDS, $speech->getData());
        }

        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $response = $this->execute($ch);

        return $response;
    }

    private function execute($curlHandle)
    {
        $response = new CurlResponse();

        curl_setopt($curlHandle, CURLOPT_HEADERFUNCTION, [$response, 'headerParser']);

        $rawResponse = curl_exec($curlHandle);
        $response
            ->setContent($rawResponse)
            ->setCode(curl_getinfo($curlHandle, CURLINFO_HTTP_CODE)) //Need to do it manually as header function stores 100
        ;

        return $response;
    }

}