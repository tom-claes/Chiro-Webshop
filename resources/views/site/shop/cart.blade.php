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
                    <p class="cart-item-name">{{ucwords($item['product_name'])}}</p>
                    <p class="cart-item-size">Maat: {{$item['size_name'] . " (" . ucwords($item['size_sort_name']) . ")"}}</p>
                    <p class="cart-item-quantity">Aantal: {{$item['quantity']}}</p>
                    <p class="cart-item-price">Prijs: {{$item['price'] . "€"}}</p>
                    <form class="cart-remove" action="{{ route('checkout.remove.fromCart', ['productId' => $item['product_id'], 'size' => $item['size_id']]) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit"><x-bin></x-bin></button>
                    </form>
                </div>
            @empty
                <div style="width: 100%">
                    <p>Je winkelkar is leeg!</p>
                </div>
            @endforelse
        </div>
        <div class="checkout-box">
            <h2 class="cart-checkout-title">Afrekenen</h2>
            <p class="cart-delivery-title">Afhaling:</p>
            <p class="cart-delivery">Op een Chiro Zondag om: 14u, 17u of 18u</p>
            <p class="cart-total">Totaal: {{ "€" . number_format($totalPrice, 2)}}</p>
            <a href="{{route('checkout.view.details')}}"><button class="cart-checkout">Afrekenen</button></a>
        </div>
    </div>
</div>
@endsection