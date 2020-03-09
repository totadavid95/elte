@extends('layouts.app')

@section('title', 'Teszt oldal')

@section('content')
    <h1 class="text-center header my-3">Bevásárlólisták</h1>

    <p><a href="{{ route('item', ['id' => 11]) }}">{{ route('item', ['id' => 11]) }}</a></p>

    <div class="list-group">
        <a href="#" class="list-group-item list-group-item-action">Dapibus ac facilisis in</a>
        <a href="#" class="list-group-item list-group-item-action list-group-item-primary">This is a primary list group item</a>
        <a href="#" class="list-group-item list-group-item-action list-group-item-secondary">This is a secondary list group item</a>
        <a href="#" class="list-group-item list-group-item-action list-group-item-success">This is a success list group item</a>
        <a href="#" class="list-group-item list-group-item-action list-group-item-danger">This is a danger list group item</a>
        <a href="#" class="list-group-item list-group-item-action list-group-item-warning">This is a warning list group item</a>
        <a href="#" class="list-group-item list-group-item-action list-group-item-info">This is a info list group item</a>
        <a href="#" class="list-group-item list-group-item-action list-group-item-light">This is a light list group item</a>
        <a href="#" class="list-group-item list-group-item-action list-group-item-dark">This is a dark list group item</a>
    </div>

@endsection

