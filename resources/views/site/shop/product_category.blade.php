@extends('layouts.app')

@section('title', 'Chiro Zuun Webshop')
    
@section('header', 'Homepage')

@section('content')

<div class="category-banner">
    <h2 class="category-title">{{$category->name}}</h2>
</div>

<div>
    @forelse ($products as $product)

    <div category-item-box>
        <img src="{{ asset('storage/IMG/' . $product->img) }}" alt="{{ $product->name }}">
        <p>{{$product->name}}</p>
        <p>{{$product->size_sort}}</p>
        <p>{{"€" . $product->price}}</p>
    </div>

    @empty
        <p>Er zijn momenteel geen producten die tot deze categorie behoren</p>
    @endforelse
</div>
    
@endsection