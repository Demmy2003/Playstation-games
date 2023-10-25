@extends('layouts.app')
@vite(['resources/sass/app.scss', 'resources/js/app.js'])
@section('content')
    <form action="{{ route('games.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" name="title" id="title" class="form-control">
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" id="description" class="form-control"></textarea>
        </div>
        <div class="form-group">
            <label for="rating">Rating</label>
            <input type="number" name="rating" id="rating" class="form-control">
        </div>
        <div class="form-group">
            <label for="genres">Genres</label>
            <p>Hold 'CTRL' to select multiple</p>
            <select name="genres[]" id="genres" class="form-control" multiple>
                @foreach ($genres as $genre)
                    <option value="{{ $genre->id }}">{{ $genre->genre_name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="modes">Modes</label>
            <p>Hold 'CTRL' to select multiple</p>
            <select name="modes[]" id="modes" class="form-control" multiple>
                @foreach ($modes as $mode)
                    <option value="{{ $mode->id }}">{{ $mode->mode }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="image">Image</label>
            <input type="file" name="image" id="image" class="form-control-file">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection
