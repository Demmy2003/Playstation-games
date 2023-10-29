<?php
    ?>
@extends('layouts.app')
@section('title')
    Home
@endsection
@section('content')
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @include('partials.filter_games')

    @if($selectedGenres > 0 || $selectedModes > 0 || $search)
        <p>Search results found: {{$games->count()}}</p>
    @endif

    @foreach($games as $game)

          @include('partials.game_list')
    @endforeach
@endsection
