<?php
    ?>
@extends('layouts.app')
@section('content')
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <h1>Games</h1>

      @foreach($games as $game)
            <div class='game-container'>
                <a class="nav-link" href="{{route('games.detail', $game)}}">
                    <h4>{{$game->title}}</h4>
                    @if($game->image)
                        <img class='pic' src="{{ asset('storage/' . $game->image) }}" alt="{{ $game->title }} Image">
                    @endif

                    <p>Rating: {{$game->rating}}</p>
                    <p>Genres:</p>
                    <ul>
                        @foreach($game->genres as $genre)
                            <li>{{$genre->genre_name}}</li>
                        @endforeach

                    </ul>
                    <p>Modes:</p>
                    <ul>
                        @foreach($game->modes as $mode)
                            <li>{{$mode->mode}}</li>
                        @endforeach

                    </ul>
                </a>
            </div>
        @endforeach
@endsection
