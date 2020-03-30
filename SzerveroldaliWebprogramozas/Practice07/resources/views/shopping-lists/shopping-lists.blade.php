@extends('layouts.app')

@section('title', 'Teszt oldal')

@section('content')
    <h1 class="text-center header my-3">Bevásárlólisták</h1>

    <div class="list-group">
        @foreach ($lists as $list)
            <div class="list-group-item list-group-item-action flex-column align-items-start">
                <div class="d-flex w-100 justify-content-between">
                    <h5 class="mb-1">
                        <a href="{{ route('shopping-list', ['id' => $list->id]) }}">{{ $list->name }}</a>
                    </h5>
                    <div class="btn-group">
                        <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Műveletek
                        </button>
                        <div class="dropdown-menu dropdown-menu-right">
                            <h6 class="dropdown-header">Elérhető műveletek</h6>
                            <a class="dropdown-item" href="{{ route('shopping-list', ['id' => $list->id]) }}"><i class="fas fa-list text-primary"></i> Megtekintés</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ route('edit-shopping-list', ['id' => $list->id]) }}">
                                <i class="far fa-edit text-success"></i> Módosítás
                            </a>
                            <a class="dropdown-item" href="#"><i class="far fa-trash-alt text-danger"></i> Törlés</a>
                        </div>
                    </div>
                </div>
                <p class="mb-1">{{ $list->items->count() }} elem, létrehozva: {{ $list->created_at }}</p>
            </div>
        @endforeach
    </div>

    <nav class="my-4" aria-label="Page navigation">
        <ul class="pagination justify-content-center">
          <li class="page-item disabled">
            <a class="page-link" href="#" tabindex="-1">Előző</a>
          </li>
          <li class="page-item disabled"><a class="page-link" href="#">1</a></li>
          <li class="page-item disabled"><a class="page-link" href="#">2</a></li>
          <li class="page-item disabled"><a class="page-link" href="#">3</a></li>
          <li class="page-item disabled">
            <a class="page-link" href="#">Következő</a>
          </li>
        </ul>
      </nav>

    <div class="text-center my-4">
        <a href="{{ route('add-shopping-list') }}" role="button" class="btn btn-lg btn-primary">Új lista</a>
    </div>

@endsection

