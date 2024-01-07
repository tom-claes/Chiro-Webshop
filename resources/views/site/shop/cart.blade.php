@extends('layouts.app')

@section('title', 'Chiro Zuun Webshop')

@section('content')
<div class="category-banner">
    <h2 class="category-title">Winkelwagen</h2>
</div>
<div class="support-page">
    <div class="flex-container">
        <div class="cart-box">
            @forelse ($cart as $item)
                <div class="cart-item-box">
                    <img class="cart-item-img" src="{{ asset($item['img']) }}" alt="{{$item['product_name']}}">
                    <p class="cart-item-name">{{$item['product_name']}}</p>
                    <p class="cart-item-size">Maat: {{$item['size_name'] . " (" . $item['size_sort_name'] . ")"}}</p>
                    <p class="cart-item-quantity">Aantal: {{$item['quantity']}}</p>
                    <p class="cart-item-price">Prijs: {{$item['price'] . "€"}}</p>
                    <form class="cart-remove" action="{{ route('shop.remove.fromCart', ['productId' => $item['product_id'], 'size' => $item['size_id']]) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit"><x-bin></x-bin></button>
                    </form>
                </div>
            @empty
                <p>Je winkelkar is leeg!</p>
            @endforelse
        </div>
        <div class="checkout-box">
            <p class="cart-total">Totaal: {{$totalPrice . "€"}}</p>
            <button class="cart-checkout" href="#">Afrekenen</button>
        </div>
    </div>
</div>
@endsection