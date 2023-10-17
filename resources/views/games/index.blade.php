<?php
    ?>
@extends('layouts.app')
@section('content')
    <h1>Games</h1>
    <ul>
        @foreach($games as $game)
            <h4>{{$game->title}}</h4>
            @if($game->image)
                    <img src="{{ asset('storage/' . $game->image) }}" alt="{{ $game->title }} Image">
            @endif

            <p>Rating: {{$game->rating}}</p>
            <ul>
                @foreach($game->genres as $genre)
                    <li>{{$genre->genre_name}}</li>
                @endforeach

            </ul>
            <ul>
                @foreach($game->modes as $mode)
                    <li>{{$mode->mode}}</li>
                @endforeach

            </ul>
        @endforeach
    </ul>
@endsection
