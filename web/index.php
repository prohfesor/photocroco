<?php
define('PATH', dirname(__DIR__));

$loader = require '../vendor/autoload.php';
$loader->add('Flyers', dirname(__DIR__).'/src');

$app = new \Slim\Slim(array(
        'templates.path' => '../templates'
    )
);
$game = new \Flyers\Croco\Game();

// Index
$app->get('/', function () use ($app) {
    $app->render('list.php');
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
$app->get('/game/:id/status', function ($id) use ($app, $game) {
    $status = $game->status($id);
    echo json_encode($status);
});

// Answer
$app->post('/game/:id/:login/answer/:answer', function ($id, $login, $answer) use ($app, $game) {
    try {
        $game->submitAnswer($id, $login, $answer);
        echo json_encode('success');
    } catch (Exception $e) {
        echo json_encode('error');
    }
});

$app->run();