<div class='game-container p-3 border rounded-3'>
    <a href="{{route('games.detail', $game)}}">
        <h4>{{$game->title}}</h4>
        @if($game->image)
            <img class='pic' src="{{ asset('storage/' . $game->image) }}" alt="{{ $game->title }} Image">
        @endif

        <p>Total Rating: {{ $game->total_rating }}</p>
        <p>Genres:</p>
        <ul>
            @foreach($game->genres as $genre)
                <p>{{$genre->genre_name}}</p>
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
