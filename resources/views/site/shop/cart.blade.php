@extends('layouts.app')

@section('title', 'Chiro Zuun Webshop')

@section('content')
<div class="category-banner">
    <h2 class="category-title">Winkelkar</h2>
</div>
<div class="support-page">
    <div class="cart-box">
        @forelse ($cart as $item)
            <div class="cart-item-box">
                <img class="cart-item-img" src="{{ asset('storage/' . $item['img']) }}" alt="{{$item['product_name']}}" style="width: 100px; height: auto; margin-right: 20px;">
                <p class="cart-item-name">{{$item['product_name']}}</p>
                <p class="cart-item-size">Maat: {{$item['size_name'] . " (" . $item['size_sort_name'] . ")"}}</p>
                <p class="cart-item-quantity">Aantal: {{$item['quantity']}}</p>
                <p class="cart-item-price">Prijs: {{$item['price'] . "€"}}</p>
                <form class="cart-remove" action="{{ route('shop.remove.fromCart', $item['product_id']) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Verwijderen</button>
                </form>
            </div>
        @empty
            <p>Je winkelkar is leeg!</p>
        @endforelse
    </div>
</div>
@endsection