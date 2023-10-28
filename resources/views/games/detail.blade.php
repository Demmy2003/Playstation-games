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
    <h1>{{ $game->title }}</h1>

    @if ($game->image)
        <img src="{{ asset('storage/' . $game->image) }}" alt="{{ $game->title }} Image">
    @endif

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
    <a href="{{ route('games.edit', $game) }}" class="btn btn-primary">Edit Game</a>
    <form method="POST" action="{{ route('games.destroy', $game) }}">
        @csrf
        @method('DELETE')
        <button class="btn btn-primary" type="submit">Delete</button>
    </form>
    <a href="{{ route('games.index') }}" class="btn btn-primary">Back to Games</a>
@endsection
