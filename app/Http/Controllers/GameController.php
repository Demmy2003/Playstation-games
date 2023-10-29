<?php

namespace App\Http\Controllers;
use App\Models\Comment;
use App\Models\Game;
use App\Models\Genre;
use App\Models\Mode;
use App\Models\Rating;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class GameController extends Controller
{
    public function index(Request $request)
    {
        $selectedGenres = $request->input('genres', []);
        $selectedModes = $request->input('modes', []);
        $search = $request->input('search');
        $clearFilters = $request->has('clear_filters');

        // Initialize a base query with filters
        $query = Game::with('genres', 'modes');

        if (!empty($selectedGenres)) {
            $query->whereHas('genres', function ($q) use ($selectedGenres) {
                $q->whereIn('genre_id', $selectedGenres);
            });
        }

        if (!empty($selectedModes)) {
            $query->whereHas('modes', function ($q) use ($selectedModes) {
                $q->whereIn('mode_id', $selectedModes);
            });
        }

        if ($clearFilters) {
            // Handle the clear filters request
            return redirect()->route('games.index')->except(['genres', 'modes']);
        }

        if ($search) {
            // Add search condition to the query
            $query->where('title', 'like', "%$search%");
        }

        // Get the filtered games
        $games = $query->get();
        $genres = Genre::all();
        $modes = Mode::all();

        return view('games.index', compact('games', 'genres', 'modes', 'selectedGenres', 'selectedModes', 'search'));
    }


    public function detail(Game $game)
    {
        $comments = Comment::all();
        return view('games.detail', compact('game', 'comments'));
    }

    public function comment(Request $request, Game $game){

        $data = $request->validate([
            'comment' => 'required|string',
        ]);
        if($data) {
            Comment::create([
                'comment' => $data['comment'],
                'game_id' => $game->id,
                'user_id' => Auth::user()->id,
            ]);
            return redirect()->route('games.detail', $game)
                ->with('success', "Comment added successfully");
        }

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
    public function rate(Game $game, $type)
    {
        $user = auth()->user();
        $existingRating = $game->ratings()->where('user_id', $user->id)->first();

        if ($existingRating) {
            // User has already rated, update the rating if needed
            if ($existingRating->type !== $type) {
                $existingRating->type = $type;
                $existingRating->save();
            }
        } else {
            // User is rating for the first time
            $newRating = new Rating([
                'user_id' => $user->id,
                'game_id' => $game->id,
                'type' => $type,
            ]);
            $newRating->save();
        }

        // Update the total rating for the game
        $game->calculateTotalRating();

        return back();
    }



}





