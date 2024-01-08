@extends('layouts.app')

@section('title', 'Chiro Zuun Webshop')

@section('content')
<div class="support-page">
<div class="ordered-title">{{'Danku voor uw bestelling: #' . $order->order_nr}}</div>
<div class="ordered-notice">Uw kan uw bestelling afhalen op de eerstvolgende Chiro Zondag om 14u, 17u of 18u, of op een latere Chiro Zondag!</div>
<div class="ordered-order">Uw bestelling:</div>
@forelse ($order_products as $item)
    

</div>
@empty
@endforelse
@endsection