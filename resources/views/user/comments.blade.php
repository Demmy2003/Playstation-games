@extends('layouts.app')

@section('content')
    <h1>Your Comments</h1>
    @if ($comments)
        <ul>
            @foreach ($comments as $comment)
                <li>
                    <strong>Game Title:</strong> {{ $comment->game->title }}<br>
                    <strong>Comment:</strong> {{ $comment->comment }}
                </li>
            @endforeach
        </ul>
    @else
        <p>You have no comments.</p>
    @endif
@endsection
