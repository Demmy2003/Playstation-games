@extends('layouts.app')
@section('title')
    {{ $game->title }}
@endsection
@section('content')
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <div class="detail-container">
        <h1>{{ $game->title }}</h1>

        @if ($game->image)
            <img src="{{ asset('storage/' . $game->image) }}" alt="{{ $game->title }} Image">
        @endif
        <p>
            <a href="{{ route('games.rate', ['game' => $game, 'rate' => 'like']) }}" class="btn btn-success">Like</a>
            <a href="{{ route('games.rate', ['game' => $game, 'rate' => 'dislike']) }}" class="btn btn-danger">Dislike</a>
        </p>

        <p>Rating: {{ $game->rating }}</p>
        <h2>Description:</h2>
        <p>{{$game->description}}</p>

        @if($game->user)
            <p>Created by: {{ $game->user->name }}</p>
        @endif

        <h2>Genres:</h2>
        <ul>
            @foreach ($game->genres as $genre)
                <li>{{ $genre->genre_name }}</li>
            @endforeach
        </ul>

        <h2>Modes:</h2>
        <ul>
            @foreach ($game->modes as $mode)
                <li>{{ $mode->mode }}</li>
            @endforeach
        </ul>
        <div class="card">
           <div class="card-body">
               <h2>
                   Comments:
               </h2>
               <form method="POST" action="{{ route('games.comment', ['game' => $game])}}">
                   @csrf
                   <input type="hidden" name="game_id" value="{{ $game->id }}">
                   <div class="form-group">
                       <label for="comment" class="form-control">Add a Comment:</label>
                       <textarea name="comment" id="comment" placeholder="Write a comment..." class="form-control @error('comment') border-red-500 @enderror"></textarea>
                       @error('comment')
                       <p class="text-red-500 text-xs">{{ $message }}</p>
                       @enderror
                   </div>
                   <button type="submit" class="btn btn-primary">Post Comment</button>
               </form>
           </div>
        </div>
        @if($game->comments)
            @foreach($game->comments as $comments)
                <div class="card">
                    <div class="card-body">
                        <article class="flex bg-gray-100 border border-gray-200 p-6 rounded-xl space-x-4">
                            <div class="flex">
                                <header class="mb-4">
                                    <h3 class="font-bold">{{ $comments->author->name }}</h3>
                                    <p class="text-xs">
                                        Posted
                                        <time>{{ $comments->created_at }}</time>
                                    </p>
                                </header>
                                <p>
                                    {{ $comments->comment }}
                                </p>
                            </div>
                        </article>
                    </div>
                </div>
            @endforeach
        @else
            <div class="card">
                <div class="card-body">
                    <p>This game doesnt have comments yet</p>
                </div>
            </div>
        @endif
    </div>
    <a href="{{ route('games.edit', $game) }}" class="btn btn-primary">Edit Game</a>
    <form method="POST" action="{{ route('games.destroy', $game) }}">
        @csrf
        @method('DELETE')
        <button class="btn btn-primary" type="submit">Delete</button>
    </form>
    <a href="{{ route('games.index') }}" class="btn btn-primary">Back to Games</a>
@endsection
