<?php
/**
 * Created by Evgeny Soynov <saboteur@saboteur.me> .
 */

require __DIR__ . '/../../bootstrap.php';

$uploader = new \SpeechKit\Uploader\Curl();

$speechKit = new \SpeechKit\SpeechKit('aaaaaaaa-ac5e-463c-a2f2-bbbbbb');
$speechKit->setUploader($uploader);

$result = $speechKit->recognize(__DIR__ . '/../Fixtures/Italian.mp3');