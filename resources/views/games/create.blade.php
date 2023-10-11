@extends('layouts.app')
@vite(['resources/sass/app.scss', 'resources/js/app.js'])
@section('content')
        <form action="{{ route('games') }}" method="POST">
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
                <select name="genres[]" id="genres" class="form-control" multiple>
                    @foreach ($genres as $genre)
                        <option value="{{ $genre->id}}">{{ $genre->genre}}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
@endsection
