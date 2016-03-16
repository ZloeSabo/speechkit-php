<?php
/**
 * Created by Evgeny Soynov <saboteur@saboteur.me> .
 */

require __DIR__ . '/../../bootstrap.php';

$uploader = new \SpeechKit\Uploader\Curl();

$speechKit = new \SpeechKit\SpeechKit('aaaaa-ac5e-463c-a2f2-aaaaa', $uploader);

$source = file_get_contents(__DIR__ . '/../Fixtures/Italian.mp3');
$speech = \SpeechKit\SpeechContent\SpeechFactory::fromData($source);

$result = $speechKit->recognize($speech);
var_dump($result);