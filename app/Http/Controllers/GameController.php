<?php

namespace App\Http\Controllers;
use App\Models\Game;

class GameController
{
    public
    function index()
    {
        $games = Game::all();
        return view('games.index', ['games' => $games]);
    }
}





