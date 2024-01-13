@extends('layouts.app')

@section('title', 'Chiro Zuun Webshop')

@section('content')
<div class="support-page" style="overflow:auto;">
<div class="ordered-title">{{'Danku voor uw bestelling: #' . $order->order_nr}}</div>
<div class="ordered-notice">Uw kan uw bestelling afhalen op de eerstvolgende Chiro Zondag om 14u, 17u of 18u, of op een latere Chiro Zondag!</div>
<div class="ordered-page">
    <div class="ordered-left">
        <div class="ordered-order">Uw bestelling:</div>
        @forelse ($order_products as $item)
            @php
                $product = \App\Models\Product::find($item->product_id);
                $size = \App\Models\Size::find($item->size_id);
                $size_sort = \App\Models\Size_sort::find($size->size_sort);
            @endphp
        
            <div class="ordered-box">
                <img class="ordered-img" src="{{asset($product->img)}}" alt="">
                <div class="ordered-info">
                    <p class="ordered-name">{{ $product->name }}</p>
                    <p class="ordered-size">{{ "Maat: " . $size->size . " (" . $size_sort->name . ")"}}</p>
                    <p class="ordered-amount">{{ "Aantal: " . $item->quantity}}</p>
                    <p class="ordered-price">{{ "Prijs: €" . $product->price}}</p>
                </div>
            </div>
        @empty
        @endforelse
    </div>
    
    <div class="order-info-box">
        <p><span class="bold">Naam: </span>{{ $order->lastname . " " . $order->firstname}}</p>
        <p><span class="bold">Email: </span>{{ $order->email}}</p>
        <p><span class="bold">Telefoonnummer: </span>{{ $order->phone}}</p>
        <p><span class="bold">Adres: </span>{{ $order->street . " " . $order->streetnr . ", " . $order->zip . " " . $order->city}}</p>
        <p><span class="bold">Totaal: </span>{{ "€" . number_format($order->total_price, 2)}}</p>
    
    </div>
</div>
@endsection