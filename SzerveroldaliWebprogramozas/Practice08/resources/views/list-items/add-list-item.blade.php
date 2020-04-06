@extends('layouts.app')

@section('title', 'Új elem')

@section('content')
    <h1 class="text-center my-4">Új elem hozzáadása ide: <strong>{{ $shoppinglist->name }}</strong></h1>

    @if (session()->has('result'))
        @if (session()->get('result') == true)
            <div class="alert alert-success" role="alert">
                A(z) <strong>{{ session()->get('list_item')->name }}</strong> nevű elem sikeresen hozzá lett adva!
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

    <div class="alert alert-secondary" role="alert">
        Új elem hozzáadása a listához.
    </div>

    <form action="{{ route('store-list-item', ['id' => $shoppinglist->id]) }}" method="post" enctype="multipart/form-data" class="card py-2 px-4">
        @csrf
        <div class="form-group">
            <label for="name">Név</label>
            <input id="name" name="name" type="text" class="form-control" >
        </div>

        <div class="form-row">
            <div class="col">
                <label for="quantity">Mennyiség</label>
                <input id="quantity" name="quantity" type="number" class="form-control" >
            </div>

            <div class="col">
                <label for="price">Ár</label>
                <input id="price" name="price" type="number" class="form-control" >
            </div>
        </div>

        <br>

        <div class="form-group">
            <label for="file">Kép</label>
            <input type="file" name="file" class="form-control-file @error('file') is-invalid @enderror" id="file">
        </div>

        <div class="text-center my-4">
            <button type="submit" class="btn btn-lg btn-primary">Létrehoz</button>
        </div>

    </form>

@endsection
