@extends('layouts.app')

@section('title', 'Lista megtekintése')

@section('content')
    @if ($shoppinglist == null)
        <div class="alert alert-danger text-center">
            Az elem nem található
        </div>
    @else
        <h1 class="text-center my-4">{{ $shoppinglist->name }}</h1>

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Név</th>
                    <th scope="col">Mennyiség</th>
                    <th scope="col">Műveletek</th>
                </tr>
            </thead>
            <tbody>
                @if (isset($items))
                    @foreach($items as $item)
                    <tr>
                        <th scope="row">{{ $loop->index + 1 }}.</th>
                        <td>{{ $item['name'] }}</td>
                        <td>{{ $item['quantity'] }} db</td>
                        <td>...</td>
                    </tr>
                    @endforeach
                @endif
            </tbody>
        </table>

        <div class="text-center my-4">
            <a href="{{ route('new-item-index') }}" role="button" class="btn btn-lg btn-primary">Új elem</a>
        </div>
    @endif

@endsection
