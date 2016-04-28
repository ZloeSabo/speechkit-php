speechkit-php
=============
[![Build Status](https://travis-ci.org/ZloeSabo/speechkit-php.svg?branch=master)](https://travis-ci.org/ZloeSabo/speechkit-php)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/ZloeSabo/speechkit-php/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/ZloeSabo/speechkit-php/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/ZloeSabo/speechkit-php/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/ZloeSabo/speechkit-php/?branch=master)

[Yandex SpeechKit](https://tech.yandex.com/speechkit/) PHP library.

## Installation

SpeechKit uses Composer, please checkout the [composer website](http://getcomposer.org) for more information.

Add SpeechKit in your composer.json and you can go ahead:

```bash
composer require zloesabo/speechkit-php
```

> SpeechKit follows the PSR-4 convention names for its classes, which means you can easily integrate `SpeechKit` classes loading in your own autoloader.

## For users of old version

Usage of previous version is strongly discouraged as it lacked concept and testing.
However, if you sure you want to use previous version of library, require it with ```composer require zloesabo/speechkit-php:~1.0```

## Usage

### Simple

```php
// Include dependencies installed with composer
require 'vendor/autoload.php';

use SpeechKit\Response\HypothesesList;
use SpeechKit\Response\Hypothesis;
use SpeechKit\Speech\SpeechContent;
use SpeechKit\SpeechKit;

$key = 'your-key-here';

$speechKit = new SpeechKit($key);

//It can be any type of stream. File, string, instance of StreamInterface, etc.
$source = fopen(__DIR__.'/some/path/to/file.mp3', 'r');

$speech = new SpeechContent($source);

//Defaults will be used: mp3, general topic, russian language
/** @var HypothesesList $result */
$result = $speechKit->recognize($speech);

/** @var Hypothesis $hyphotesis */
foreach ($result as $hyphotesis) {
    echo sprintf(
        'Confidence: %.2f Content: %s',
        $hyphotesis->getConfidence(),
        $hyphotesis->getContent()
    ), PHP_EOL;
}
```

### Advanced

```php

require 'vendor/autoload.php';

use SpeechKit\Client\Curl;
use SpeechKit\Response\HypothesesList;
use SpeechKit\Response\Hypothesis;
use SpeechKit\ResponseParser\SimpleXML;
use SpeechKit\Speech\SpeechContent;
use SpeechKit\Speech\SpeechContentInterface;
use SpeechKit\SpeechKit;
use SpeechKit\Uploader\Uploader;
use SpeechKit\Uploader\UrlGenerator;

$key = 'your-key-here';

$urlGenerator = new UrlGenerator($key);

//You could use any type of client which implements ClientInterface
$client = new Curl();
$uploader = new Uploader($urlGenerator, $client);

//You could use any type of parser which implements ResponseParserInterface
$responseParser = new SimpleXML();

$speechKit = new SpeechKit($key, $uploader, $responseParser);

$source = fopen(__DIR__.'/some/path/to/file.mp3', 'r');
$speech = new SpeechContent($source);

//These settings are default, so you can skip setting them
$speech->setContentType(SpeechContentInterface::CONTENT_MP3);
$speech->setTopic(SpeechContentInterface::TOPIC_GENERAL);
$speech->setLang(SpeechContentInterface::LANG_RU);
$speech->setUuid(bin2hex(openssl_random_pseudo_bytes(16)));

/** @var HypothesesList $result */
$result = $speechKit->recognize($speech);

/** @var Hypothesis $hyphotesis */
foreach ($result as $hyphotesis) {
    echo sprintf(
        'Confidence: %.2f Content: %s',
        $hyphotesis->getConfidence(),
        $hyphotesis->getContent()
    ), PHP_EOL;
}
```
