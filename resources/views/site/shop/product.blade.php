@extends('layouts.app')

@section('title', 'Chiro Zuun Webshop')
    
@section('header', 'Homepage')

@section('content')
    <div class="item-box">
        <img class="item-img" src="{{ asset('storage/' . $product->img) }}" alt="{{ $product->name }}">
        <div class="item-right-side">
            <p class="item-name">{{$product->name}}</p>
            <p class="item-description">{{$product->description}}</p>
            <p class="item-size">{{$product->size_sort}}</p>
            <p class="item-price">{{"€" . $product->price}}</p>

            <form action="">
                <x-primary-button>In winkelmandje</x-primary-button>
            </form>
        </div>
    </div>
@endsection;