@extends('layouts.app')

@section('title', 'Új lista')

@section('content')
    <h1>Új lista</h1>
    <p>Új bevásárlólista hozzáadása.</p>

    @if(isset($data))
        @php
            var_dump($data);
        @endphp
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

    <form action="{{ route('new-list-store') }}" method="post">
        @csrf
        <div class="form-group">
            <label for="name">Név</label>
            <input name="name" type="text" class="form-control" >
        </div>

        <button type="submit" class="btn btn-primary">Létrehoz</button>
    </form>
@endsection
