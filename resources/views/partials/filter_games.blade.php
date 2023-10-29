<form method="GET" action="{{ route('games.index') }}">
<div class="search-container p-3 border border-primary-subtle rounded-3">
    <div class="row">
        <div class="col">
            <h1>Games</h1>
        </div>
        <div class="col-md-auto">
                <input type="text" name="search" placeholder="Search for games...">
        </div>
        <div class="col-md-auto">
            <div class="dropdown">
                <button class="btn btn-info dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false" data-bs-auto-close="outside">
                    Genres
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
                </div>
            </div>
        </div>
                <div class="col-md-auto">
                    <div class="dropdown">
                        <button class="btn btn-info dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false" data-bs-auto-close="outside">
                            Game Modes
                        </button>
                        <div class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDropdown">
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
                        </div>
                    </div>
                </div>

        <div class="col-md-auto">
                <button type="submit" class="btn btn-primary btn-sm">Apply Filters</button>
                <a href="{{ route('games.index') }}" class="btn btn-sm btn-secondary">Remove Filters</a>
        </div>

    </div>
</div>
</form>
