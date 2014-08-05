<?php
/**
 * Created by Evgeny Soynov <saboteur@saboteur.me> .
 */

if (intval(ini_get('memory_limit')) < 64) {
    ini_set('memory_limit', '64M');
}

$loader = require __DIR__.'/../vendor/autoload.php';
$loader->add('SpeechKit\Test', __DIR__);