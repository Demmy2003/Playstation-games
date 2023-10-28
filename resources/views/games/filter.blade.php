@extends('layouts.app')

@section('content')
<h1>filter results</h1>
    @if(isset($games) && $games->count() > 0)
        <h2>Filtered Games</h2>
        @foreach($games as $game)
            @include('partials.game_list')
        @endforeach
    @else
        <p>No games match the selected filters.</p>
    @endif
@endsection
