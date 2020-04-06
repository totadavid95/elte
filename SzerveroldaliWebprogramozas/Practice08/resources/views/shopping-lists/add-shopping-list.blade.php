@extends('layouts.app')

@section('title', 'Új lista')

@section('content')
    <h1 class="text-center my-4">Új lista</h1>
    <div class="alert alert-secondary" role="alert">
        Új bevásárlólista hozzáadása.
    </div>

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

    <form action="{{ route('store-shopping-list') }}" method="post" class="card py-2 px-4">
        @csrf
        <div class="form-group">
            <label for="name">Név</label>
            <input name="name" type="text" class="form-control" >
        </div>

        <div class="text-center my-4">
            <button type="submit" class="btn btn-lg btn-primary">Létrehoz</button>
        </div>

    </form>
@endsection
