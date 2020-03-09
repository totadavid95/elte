@extends('layouts.app')

@section('title', 'Lista megtekintése')

@section('content')
    <p>Megadott ID: {{ $id }}</p>
    
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Név</th>
                <th scope="col">Mennyiség</th>
            </tr>
        </thead>
        <tbody>
            @foreach($items as $item)
            <tr>
                <th scope="row">{{ $loop->index + 1 }}.</th>
                <td>{{ $item['name'] }}</td>
                <td>{{ $item['quantity'] }} db</td>
            </tr>
            @endforeach
        </tbody>
    </table>

@endsection