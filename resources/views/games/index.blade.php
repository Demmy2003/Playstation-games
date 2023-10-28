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
    <div class="search-container">
        <div class="row">
            <div class="col-8">
                <h1>Games</h1>
            </div>
            <div class="col-md-auto">
                <form action="{{ route('games.search') }}" method="GET">
                    <input type="text" name="search" placeholder="Search for games...">
                    <button type="submit">Search</button>
                </form>
            </div>
            <div class="col">
                @include('partials.filter_games')
            </div>

        </div>
    </div>

    @foreach($games as $game)

          @include('partials.game_list')
    @endforeach
@endsection
