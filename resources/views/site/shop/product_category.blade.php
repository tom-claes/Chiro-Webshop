@extends('layouts.app')

@section('title', 'Chiro Zuun Webshop')

@section('content')

<div class="category-banner">
    <h2 class="category-title">{{ucwords($category->name)}}</h2>
</div>

<div class="products-container">
    @forelse ($products as $product)
    <a href="{{ route('shop.product', ['productId' => $product->id]) }}">

        <div class="category-item-box">
            <img class="category-item-img" src="{{ asset($product->img) }}" alt="{{ $product->name }}">
            <p class="category-item-name">{{ucwords($product->name)}}</p>
            <p class="category-item-size">{{ucwords($product->sizeSort->name)}}</p>
            <p class="category-item-price">{{"€" . $product->price}}</p>
        </div>

    </a>

    @empty
        <p>Er zijn momenteel geen producten die tot deze categorie behoren</p>
    @endforelse
</div>
    
@endsection