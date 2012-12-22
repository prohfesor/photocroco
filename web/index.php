<?php
$loader = require '../vendor/autoload.php';
$loader->add('Flyers', dirname(__DIR__).'/src');

require "../src/Flyers/fastcomet/flyInit.php";
$db = flyDb::getInstance();
$db->connect( DB_HOST, DB_USER , DB_PASS , DB_NAME );

$app = new \Slim\Slim();

$app->get('/hello/:name', function ($name) {
    $a = new \Flyers\Croco\Game();
});

$app->run();