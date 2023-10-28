@extends('layouts.app')
@section('title')
    Edit
@endsection
@section('content')


    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Edit Game: {{ $game->title }}</div>

                    <div class="card-body">

                        <form action="{{ route('games.update', $game) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <!-- Editable fields for the game -->
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" name="title" id="title" value="{{ $game->title }}" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea name="description" id="description" class="form-control">{{ $game->description }}</textarea>
                            </div>

                            <div class="form-group">
                                <label for="rating">Rating</label>
                                <input type="number" name="rating" id="rating" value="{{ $game->rating }}" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="genres">Genres</label>
                                <ul>
                                    @foreach($genres as $genre)
                                        <li>
                                            <input type="checkbox" name="genres[]" value="{{ $genre->id }}" {{ $game->genres->contains($genre) ? 'checked' : '' }}>
                                            <label>{{ $genre->genre_name }}</label>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="form-group">
                                <label for="modes">Modes</label>
                                <ul>
                                    @foreach($modes as $mode)
                                        <li>
                                            <input type="checkbox" name="modes[]" value="{{ $mode->id }}" {{ $game->modes->contains($mode) ? 'checked' : '' }}>
                                            <label for="modes[]">{{ $mode->mode }}</label>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>

                            <!-- Editable fields for genres and modes (use checkboxes or select inputs) -->

                            <!-- Image upload field for updating the game's image -->

                            <div class="form-group">
                                <label for="image">Image</label>
                                <input type="file" name="image" id="image" class="form-control">
                            </div>

                            <button type="submit" class="btn btn-primary">Update Game</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>

@endsection
