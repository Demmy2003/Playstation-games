<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Genre;
use App\Models\Mode;

class CreateController
{
    public function create() {

            $genres = Genre::all();
            $modes = Mode::all();

        return view('create_games', compact('genres','modes'));
    }
    public function edit(Game $game)
    {
        $this->authorize('edit', $game);
        $genres = Genre::all();
        $modes = Mode::all();


        return view('edit', compact('game', 'genres', 'modes'));
    }


}
