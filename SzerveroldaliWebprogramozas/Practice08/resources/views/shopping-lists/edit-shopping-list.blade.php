@extends('layouts.app')

@section('title', 'Lista szerkesztése')

@section('content')
    <h1 class="text-center my-4">Lista szerkesztése: <strong>{{ $list->name }}</strong></h1>

    @if (session()->has('result'))
        @if (session()->get('result') == true)
            <div class="alert alert-success" role="alert">
                A(z) <strong>{{ session()->get('list')->name }}</strong> nevű lista sikeresen hozzá lett adva!
            </div>
        @endif
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <p>A validáció során az alábbi hibák történtek:</p>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('update-shopping-list', ['id' => $list->id]) }}" method="post" class="card py-2 px-4">
        @csrf

        <div class="form-group">
            <label for="name">Név</label>
            <input name="name" type="text" class="form-control" value="{{ $list->name }}">
        </div>

        <div class="text-center my-4">
            <button type="submit" class="btn btn-lg btn-primary">Módosítás</button>
        </div>

    </form>
@endsection
