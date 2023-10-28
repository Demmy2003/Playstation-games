<form method="GET" action="{{ route('games.filter') }}">
    <div class="dropdown">
        <button class="btn btn-info dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false" data-bs-auto-close="outside">
            Filter
        </button>
        <div class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDropdown">
            <div>
                <li><h6 class="dropdown-header">Genres</h6></li>
                @foreach($genres as $genre)
                    <li class="dropdown-item">
                    <label>
                        <input type="checkbox" name="genres[]" value="{{ $genre->id }}">
                        {{ $genre->genre_name }}
                    </label>
                    </li>
                @endforeach
            </div>
            <li><hr class="dropdown-divider"></li>
            <!-- Modes -->
            <div>
                <li><h6 class="dropdown-header">Modes</h6></li>
                @foreach($modes as $mode)
                    <li class="dropdown-item">
                    <label>
                        <input type="checkbox" name="modes[]" value="{{ $mode->id }}">
                        {{ $mode->mode }}
                    </label>
                    </li>
                @endforeach
            </div>
            <li><hr class="dropdown-divider"></li>
            <div>
                <button type="submit" class="btn btn-primary btn-sm">Apply Filters</button>
                <a href="{{ route('games.filter') }}" class="btn btn-sm btn-secondary">Remove Filters</a>
            </div>
        </div>
    </div>
</form>
