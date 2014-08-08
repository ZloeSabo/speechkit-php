speechkit-php
=============

Yandex SpeechKit for PHP


## Usage
```php
use SpeechKit\Uploader\Curl as CurlUploader,
    SpeechKit\ResponseParser\SimpleXML as SimpleXMLParser,
    SpeechKit\SpeechKit,
    SpeechKit\SpeechContent\SpeechFactory,
    SpeechKit\SpeechContent\SpeechContentInterface,
    SpeechKit\Uploader\UploaderInterface
    ;

$uploader = new CurlUploader;
//General topic and russian language are by default so you can omit next 4 lines
$uploader->options()
    ->setTopic(UploaderInterface::TOPIC_GENERAL)
    ->setLang(UploaderInterface::LANG_RU)
;

$parser = new SimpleXMLParser;

$speechKit = new SpeechKit('your key here');
$speechKit
    ->setUploader($uploader)
    ->setResponseParser($parser)
;

$speech = SpeechFactory::fromData(__DIR__ . '/../Fixtures/Italian.mp3');
//Can omit this in case of mp3 which is default
$speech->setContentType(SpeechContentInterface::CONTENT_MP3);

$result = $speechKit->recognize($speech);
```

*Notice*: resulting array uses confidence weights as keys. So use array_values if you need array starting with 0 index