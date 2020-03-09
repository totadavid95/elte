@extends('layouts.app')

@section('title', 'Teszt oldal')

@section('content')
    <h1 class="text-center header my-3">Bevásárlólisták</h1>

    {{ $lists }}


    <div class="list-group">
        <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
            <div class="d-flex w-100 justify-content-between">
                <h5 class="mb-1">List group item heading List group item heading </h5>
                <div class="btn-group">
                    <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Műveletek
                    </button>
                    <div class="dropdown-menu dropdown-menu-right">
                        <h6 class="dropdown-header">Elérhető műveletek</h6>
                        <button class="dropdown-item" type="button">
                            <i class="far fa-edit text-success"></i> Módosítás
                        </button>
                        <button class="dropdown-item" type="button">
                            <i class="far fa-trash-alt text-danger"></i> Törlés
                        </button>
                        <div class="dropdown-divider"></div>
                        <button class="dropdown-item">
                            <i class="fas fa-list text-primary"></i> Megtekintés
                        </button>
                      </div>
                  </div>
            </div>
            <p class="mb-1">Donec id elit non mi porta gravida at eget metus. Maecenas sed diam eget risus varius blandit.</p>
        </a>
        <a href="#" class="list-group-item list-group-item-action list-group-item-primary">This is a primary list group item</a>
        <a href="#" class="list-group-item list-group-item-action list-group-item-secondary">This is a secondary list group item</a>
        <a href="#" class="list-group-item list-group-item-action list-group-item-success">This is a success list group item</a>
        <a href="#" class="list-group-item list-group-item-action list-group-item-danger">This is a danger list group item</a>
        <a href="#" class="list-group-item list-group-item-action list-group-item-warning">This is a warning list group item</a>
        <a href="#" class="list-group-item list-group-item-action list-group-item-info">This is a info list group item</a>
        <a href="#" class="list-group-item list-group-item-action list-group-item-light">This is a light list group item</a>
        <a href="#" class="list-group-item list-group-item-action list-group-item-dark">This is a dark list group item</a>
    </div>

    <div class="text-center my-4">
        <a href="{{ route('new-list-index') }}" class="btn-lg btn-primary" role="button" aria-pressed="true">
            Új lista
        </a>
    </div>

@endsection

