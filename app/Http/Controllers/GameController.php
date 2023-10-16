<?php

namespace App\Http\Controllers;
use App\Models\Game;
use App\Models\Genre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class GameController
{
    public   function index()
    {
        $games = Game::with('genres')->get();
        return view('games.index', ['games' => $games]);
    }
    public function create()
    {

        $genres = Genre::all();

        return view('games.create', compact('genres'));

    }
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'rating' => 'required|numeric',
            'genres' => 'required|array',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        Storage::disk('public')->makeDirectory('game_images');

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('game_images', 'public');
            $data['image'] = $imagePath;
        }


        $game = Game::create([
            'title' => $data['title'],
            'description' => $data['description'],
            'rating' => $data['rating'],
            'image' => $imagePath,
        ]);

        $game->genres()->attach($data['genres']);

        return redirect()->route('games.index');
    }
}





