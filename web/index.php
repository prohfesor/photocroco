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
$app->get('/', function () use ($app, $game) {
    $games = $game->getActiveGames();
    $app->render('list.php', array('games' => $games));
});

// Create new game
$app->post('/new/:login/:question', function ($login, $question) use ($app, $game) {
    $gameId = $game->create($login, $question);
    echo json_encode(array('id' => $gameId));
});

// Get game status
$app->get('/game/:id/status/', function ($id) use ($app, $game) {
    $status = $game->status($id);
    echo json_encode($status);
});

// Get games results
$app->get('/game/:id/results/', function ($id) use ($app, $game) {
    $game = $game->get($id);
    if ($game['status'] != \Flyers\Croco\Game::GAME_CLOSED) header('Location: /game/'.$id);
    $app->render('results.php', array('game' => $game));
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

// Show game
$app->get('/game/:id', function ($id) use ($app, $game) {
    $app->render('game.php', array('id'=>$id) );
});

// Answer
$app->post('/game/:id/:login/answer/:answer', function ($id, $login, $answer) use ($app, $game) {
    try {
        $result = $game->submitAnswer($id, $login, $answer);
        echo json_encode($result);
    } catch (Exception $e) {
        echo json_encode('error');
    }
});

$app->run();