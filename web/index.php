<?php
define('PATH', dirname(__DIR__));

$loader = require '../vendor/autoload.php';
$loader->add('Flyers', dirname(__DIR__).'/src');

$app = new \Slim\Slim();
$game = new \Flyers\Croco\Game();

// Index
$app->get('/', function () use ($app) {

});

// Create new game
$app->post('/new/:login/:question', function ($login, $question) use ($app, $game) {
    $gameId = $game->create($login, $question);
    echo json_encode(array('id' => $gameId));
});

// Get/join game
$app->post('/game/:id/:login', function ($id, $login) use ($app, $game) {
    try {
        $game->join($id, $login);
        $status = $game->status($id);
        echo json_encode($status);
    } catch (Exception $e) {
        echo json_encode('error');
    }
});

// Get game status
$app->get('/game/:id/status', function ($id) use ($app) {

});

// Answer
$app->post('/game/:id/answer/:answer', function ($id, $answer) use ($app) {

});

$app->run();