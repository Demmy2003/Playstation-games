@extends('layouts.app')
@section('title')
    Search
@endsection
@section('content')
    <h1>Search Results for "{{ $search }}"</h1>

    <form action="{{ route('games.search') }}" method="GET">
        @csrf
        <input type="text" name="search" value="{{ $search }}" placeholder="Search for games...">
        <button type="submit">Search</button>
    </form>

    @if ($games->count() > 0)
        <p>Search results found: {{$games->count()}}</p>
        @foreach ($games as $game)
            @include('partials.game_list')
        @endforeach
    @else
        <p>Search results found: none</p>
        <p>No games found for your search query. Please try a different name or check for typo's.</p>
    @endif
@endsection
