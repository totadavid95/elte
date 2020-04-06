@extends('layouts.app')

@section('title', 'Lista megtekintése')

@section('content')
    @if ($shoppinglist == null)
        <div class="alert alert-danger text-center">
            Az elem nem található
        </div>
    @else
        <h1 class="text-center my-4">{{ $shoppinglist->name }}</h1>

        <div class="list-group">
            @foreach ($shoppinglist->items as $item)
                <div class="list-group-item list-group-item-action flex-column align-items-start">
                    <div class="d-flex w-100 justify-content-between">
                        <h5 class="mb-1">
                            {{ $item->name }} ({{ $item->quantity }} db) ({{ $item->price }} Ft)
                        </h5>
                        <div class="btn-group">
                            <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Műveletek
                            </button>
                            <div class="dropdown-menu dropdown-menu-right">
                                <h6 class="dropdown-header">Elérhető műveletek</h6>
                                <a class="dropdown-item" href="#"><i class="fas fa-list text-primary"></i> Megtekintés</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#">
                                    <i class="far fa-edit text-success"></i> Módosítás
                                </a>
                                <form action="#" method="post">
                                    @csrf
                                    <button class="dropdown-item">
                                        <i class="far fa-trash-alt text-danger"></i> Törlés
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <p class="mb-1"></p>
                </div>
            @endforeach
        </div>

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
            <a href="{{ route('add-list-item', ['id' => $shoppinglist->id]) }}" role="button" class="btn btn-lg btn-primary">Új elem</a>
        </div>
    @endif

@endsection
