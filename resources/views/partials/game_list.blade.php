<div class='game-container p-3 text-primary-emphasis bg-primary-subtle border border-primary-subtle rounded-3'>
    <a class="bg-primary-subtle" href="{{route('games.detail', $game)}}">
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
