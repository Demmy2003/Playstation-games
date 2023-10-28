<?php

namespace App\Http\Controllers;
use App\Models\Game;
use App\Models\Genre;
use App\Models\Mode;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class GameController extends Controller
{
    public function index()
    {
        $games = Game::all();
        $genres = Genre::all(); // Load genres
        $modes = Mode::all();   // Load modes
        return view('games.index',  ['games' => $games, 'genres' => $genres, 'modes' => $modes]);
    }
    public function search(Request $request)
    {
        $search = $request->input('search');

        $games = Game::where('title', 'like', "%$search%")->get();

        return view('games.search', compact('games', 'search'));
    }
    public function filter(Request $request)
    {
        // Get selected genres and modes from the form
        $selectedGenres = $request->input('genres', []);
        $selectedModes = $request->input('modes', []);

        // Query the games based on the selected filters
        $query = Game::with('genres', 'modes');

        if ($request->has('clear_filters')) {
            // Redirect to the filter page without the 'genres' and 'modes' parameters
            return redirect()->route('games.filter')->except(['genres', 'modes']);
        }
// Check if any genres are selected
        if (!empty($selectedGenres)) {
            foreach ($selectedGenres as $genreId) {
                $query->whereHas('genres', function ($q) use ($genreId) {
                    $q->where('genre_id', $genreId);
                });
            }
        }

// Check if any modes are selected
        if (!empty($selectedModes)) {
            foreach ($selectedModes as $modeId) {
                $query->whereHas('modes', function ($q) use ($modeId) {
                    $q->where('mode_id', $modeId);
                });
            }
        }

// Get the filtered games
        $games = $query->get();


        return view('games.filter', compact( 'games', 'selectedGenres', 'selectedModes'));
    }
    public function detail(Game $game)
    {
        return view('games.detail', compact('game'));
    }

    public function store(Request $request)
    {
        if(Auth::check()) {
            $user = Auth::user()->id;

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

            }


            $game = Game::create([
                'title' => $data['title'],
                'description' => $data['description'],
                'rating' => $data['rating'],
                'image' => $imagePath,
                'user_id' => $user,
            ]);

            $game->genres()->attach($data['genres']);
            $game->modes()->attach($data['modes']);

            return redirect()->route('games.index')->with('success', "$game->title has been added successfully");
        }
    }
    public function edit(Game $game)
    {
        $this->authorize('edit', $game);
        $genres = Genre::all();
        $modes = Mode::all();

        return view('games.edit', compact('game', 'genres', 'modes'));
    }
    public function update(Request $request, Game $game)
    {
        $this->authorize('edit', $game);
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

        return redirect()->route('games.detail', $game)->with('success', "$game->title updated successfully");
    }
    public function destroy(Game $game)
    {
        $this->authorize('delete', $game);
        $game->delete();
        $game->genres()->detach();
        $game->modes()->detach();
        return redirect()->route('games.index')
            ->with('success',  "$game->title was successfully deleted");
    }



}





