<?php

namespace App\Http\Controllers;
use App\Models\Game;
use App\Models\Genre;

class GameController
{
    public   function index()
    {
        $games = Game::all();
        return view('games.index', ['games' => $games]);
    }
    public function create()
    {
        $genres = Genre::all();
        $games = Game::all();
        return view('games.create', ['games' => $games , 'genres' => $genres]);
    }
}





