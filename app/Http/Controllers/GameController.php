<?php

namespace App\Http\Controllers;
use App\Models\Game;
use App\Models\Genre;
use App\Models\Mode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class GameController
{
    public function index()
    {
        $games = Game::with('genres')->get();
        return view('games.index', ['games' => $games]);
    }
    public function detail(Game $game)
    {
        return view('games.detail', compact('game'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'rating' => 'required|numeric',
            'genres' => 'required|array',
            'modes' => 'required|array',
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
        $game->modes()->attach($data['modes']);

        return redirect()->route('games.index');
    }
    public function edit(Game $game)
    {
        $genres = Genre::all();
        $modes = Mode::all();

        return view('games.edit', compact('game', 'genres', 'modes'));
    }
    public function update(Request $request, Game $game)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'rating' => 'required|numeric',
            'genres' => 'required|array',
            'modes' => 'required|array',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('game_images', 'public');
            $data['image'] = $imagePath;
        }

        // Update the game with the new data
        $game->update($data);

        // Sync genres and modes as needed
        $game->genres()->sync($data['genres']);
        $game->modes()->sync($data['modes']);

        return redirect()->route('games.detail', $game)->with('success', 'Game updated successfully');
    }
    public function destroy(Game $game)
    {

        $game->delete();
        $game->genres()->detach();
        $game->modes()->detach();
        return redirect()->route('games.index')
            ->with('success', 'game deleted successfully');
    }

}





