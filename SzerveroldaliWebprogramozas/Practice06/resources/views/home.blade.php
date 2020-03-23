@extends('layouts.app')

@section('title', 'Teszt oldal')

@section('content')
    <h1 class="text-center header my-3">Bevásárlólisták</h1>

    <p class="my-4">{{ $lists }}</p>

    <div class="list-group">
        @foreach ($lists as $list)
            <a href="{{ route('item', ['id' => $list->id]) }}" class="list-group-item list-group-item-action">{{ $list->name }}</a>
        @endforeach
    </div>

    <div class="text-center my-4">
        <a href="{{ route('new-list-index') }}" role="button" class="btn btn-lg btn-primary">Új lista</a>
    </div>

@endsection

