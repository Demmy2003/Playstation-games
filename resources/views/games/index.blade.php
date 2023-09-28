<?php
    ?>
@extends('layouts.app')
@section('content')
    <h1>Games</h1>
    <ul>
        @foreach($games as $game)
            <li>{{$game->title}}</li>
        @endforeach
    </ul>
@endsection
