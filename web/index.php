<?php
$loader = require '../vendor/autoload.php';
$loader->add('Flyers', dirname(__DIR__).'/src');

$app = new \Slim\Slim();

$app->get('/hello/:name', function ($name) {
    $a = new \Flyers\Croco\Game();
});

$app->run();