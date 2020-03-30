@extends('layouts.app')

@section('title', 'Lista törlése')

@section('content')
    <h1 class="text-center my-4">Lista törlése</h1>

    @if (session()->has('result'))
        @if (session()->get('result') == true)
            <div class="alert alert-success text-center" role="alert">
                A(z) <strong>{{ session()->get('name') }}</strong> nevű lista sikeresen ki lett törölve!
            </div>
        @else
            <div class="alert alert-danger text-center" role="alert">
                A törlés nem sikerült
            </div>
        @endif
    @endif
@endsection
