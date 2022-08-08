@extends('layouts.app')

@section('title')Shopping cart @endsection
@section('content')
    <div class="logout">
        <a href={{route('logout-form')}}>Log out</a>
    </div>
    <div class="products">
        @foreach($userProducts as $userProduct)
            <div>{{$userProduct->name}}</div>
        @endforeach
    </div>
@endsection
