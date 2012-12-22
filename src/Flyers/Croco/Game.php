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
            'winner' => '',
            'preload' => '',
            'users' => array(),
            'photos' => array(),
            'answers' => array()
        );
        $this->set($game['id'], $game);
        Photo::queueGrab($game['id'], $question);
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

    public function submitAnswer($gameId, $login, $answer)
    {
        // TODO: Validate game and user
        $time = time();
        $game = $this->get($gameId);
        $game['answers'][$time][$login] = $answer;
        if ($answer == $game['question']) {
            $game['status'] = self::GAME_CLOSED;
            $game['winner'] = $login;
        } else {
            $game['photos'][] = $this->getNextPhoto($game['preload']);
            Photo::queueGrab($game['id'], $game['question']);
        }
        $this->set($gameId, $game);
    }

    public function preloadPhoto($gameId, $question, $preload)
    {
        $game = $this->get($gameId);
        if (empty($game['photos'])) {
            $game['photos'][] = $this->getNextPhoto($preload);
            Photo::queueGrab($game['id'], $question);
        } else {
            $game['preload'] = $preload;
        }
        $this->set($gameId, $game);
    }

    public function getNextPhoto($preload)
    {
        $name = uniqid().'.jpg';
        rename(PATH.'/data/preload/'.$preload, PATH."/web/photos/{$name}");
        return $name;
    }
}