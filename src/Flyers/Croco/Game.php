<?php
namespace Flyers\Croco;

class Game
{
    const GAME_ACTIVE = 'active';
    const GAME_CLOSED = 'closed';

    public function get($gameId)
    {
        $game = file_get_contents(PATH."/data/games/{$gameId}.json");
        return json_decode($game, true);
    }

    public function set($gameId, $game)
    {
        file_put_contents(PATH."/data/games/{$gameId}.json", json_encode($game));
    }

    public function create($login, $question)
    {
        $game = array(
            'id' => uniqid(),
            'admin' => $login,
            'question' => $question,
            'status' => self::GAME_ACTIVE,
            'users' => array(),
            'photos' => array(),
            'answers' => array()
        );
        $this->set($game['id'], $game);
        return $game['id'];
    }

    public function join($gameId, $login)
    {
        // TODO: Validate game and user
        $game = $this->get($gameId);
        $game['users'][] = $login;
        $this->set($gameId, $game);
    }

    public function status($gameId)
    {
        // TODO: Validate game and user
        $game = $this->get($gameId);
        $status = array(
            'id' => $gameId,
            'admin' => $game['admin'],
            'status' => $game['status'],
            'photo' => end($game['photos'])
        );
        if ($game['status'] == self::GAME_CLOSED) {
            $status['question'] = $game['question'];
            $status['answers'] = $game['answers'];
        }
        return $status;
    }
}