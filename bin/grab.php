<?php
define('PATH', dirname(__DIR__));

$loader = require '../vendor/autoload.php';
$loader->add('Flyers', dirname(__DIR__).'/src');

// Load image
$gameId = $_SERVER['argv'][1];
$question = $_SERVER['argv'][2];

$preload = md5($gameId.$question).'.jpg';
$url = "http://nophoto.info/{$question}/320x240.jpg";

$photo = new \Flyers\Croco\Photo();
$photo->grab($url, PATH.'/data/preload/'.$preload);

$game = new \Flyers\Croco\Game();
$game->preloadPhoto($gameId, $question, $preload);