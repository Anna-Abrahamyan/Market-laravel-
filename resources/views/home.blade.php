@extends('layouts.app')

@section('title')home @endsection

@section('content')
<div class =  "container">
    <div class="header">
        <div class="cart">
            <a href="{{ route('shopping-cart') }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart-plus-fill" viewBox="0 0 16 16">
                    <path d="M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.405-1.621A.5.5 0 0 0 2 1H.5zM6 14a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm7 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0zM9 5.5V7h1.5a.5.5 0 0 1 0 1H9v1.5a.5.5 0 0 1-1 0V8H6.5a.5.5 0 0 1 0-1H8V5.5a.5.5 0 0 1 1 0z"/>
                </svg>
            </a>
        </div>
        <div class="link">
            <a href="/register">Register</a>
            <a href="/login">Login</a>
        </div>
    </div>
    <div class="products">
        @foreach($products as $product)
        <div class="product" id="{{$product->id}}">
            {{$product-> name}}
        </div>
        @endforeach
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.js"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        const getProducts = document.querySelectorAll('.product');
        getProducts.forEach(val => {
            val.addEventListener('click', function(e) {
                  $.ajax( "http://127.0.0.1:8000/", {
                      dataType: 'json',
                      type: 'post',
                      data: JSON.stringify( {id: e.target.id }),
                      success: function() { alert('ok'); },
                      error: function() { alert("You did't sign in."); }
                  });
            });
        })

    </script>
</div>
@endsection
