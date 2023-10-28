@extends('layouts.app')
@vite(['resources/sass/app.scss', 'resources/js/app.js'])
@section('title')
    Create
@endsection
@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Create a Game') }}</div>

                    <div class="card-body">
                        <form action="{{ route('games.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group">
                                <label for="title" >Title</label>
                                <input type="text" name="title" id="title"  class="form-control @error('title') is-invalid @enderror"  value="{{ old('title') }}">
                                @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror"  >{{ old('description') }}</textarea>
                                @error('description')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="rating" >Rating</label>
                                <input type="number" name="rating" id="rating" class="form-control @error('rating') is-invalid @enderror"  value="{{ old('rating') }}">
                                @error('rating')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="genres" >Genres</label>
                                <p>Hold 'CTRL' to select multiple</p>
                                <select name="genres[]" id="genres" class="form-control @error('genres') is-invalid @enderror"  multiple>
                                    @foreach ($genres as $genre)
                                        <option value="{{ $genre->id }}">{{ $genre->genre_name }}</option>
                                    @endforeach
                                </select>
                                @error('genres')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="modes" >Modes</label>
                                <p>Hold 'CTRL' to select multiple</p>
                                <select name="modes[]" id="modes" class="form-control @error('modes') is-invalid @enderror"   multiple>
                                    @foreach ($modes as $mode)
                                        <option value="{{ $mode->id }}">{{ $mode->mode }}</option>
                                    @endforeach
                                </select>
                                @error('modes')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="image" >Image</label>
                                <input type="file" name="image" id="image" class="form-control @error('image') is-invalid @enderror"  >
                                @error('image')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
