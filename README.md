speechkit-php
=============

Yandex SpeechKit for PHP

## Installation

SpeechKit uses Composer, please checkout the [composer website](http://getcomposer.org) for more information.

Add SpeechKit in your composer.json and you can go ahead:

```bash
$ composer require zloesabo/speechkit-php:dev-master
```

> SpeechKit follows the PSR-0 convention names for its classes, which means you can easily integrate `SpeechKit` classes loading in your own autoloader.

## Usage

**Notice**: recognition result array uses confidence weights as keys. So use array_values if you need array starting with 0 index


### Simple

```php
// Include dependencies installed with composer
require 'vendor/autoload.php';

use SpeechKit\SpeechKit,
    SpeechKit\SpeechContent\SpeechFactory,
    SpeechKit\SpeechContent\SpeechContentInterface,
    ;

$speechKit = new SpeechKit('your key here');
$speech = SpeechFactory::fromData(__DIR__ . '/../Fixtures/Italian.mp3');
$speech->setContentType(SpeechContentInterface::CONTENT_MP3);

$result = $speechKit->recognize($speech);
``` 

### Advanced

```php

// Include dependencies installed with composer
require 'vendor/autoload.php';

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

