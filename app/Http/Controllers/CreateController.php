<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use App\Models\Mode;

class CreateController
{
    public function create() {

            $genres = Genre::all();
            $modes = Mode::all();

        return view('create_games', compact('genres','modes'));
    }
}
