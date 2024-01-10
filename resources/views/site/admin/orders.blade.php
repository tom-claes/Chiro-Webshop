@extends('layouts.admin')

@section('title', 'Chiro Zuun Webshop')

@section('content')
<p class="admin-heading">Bestellingen</p>

<form method="GET" action="{{ route('admin.contact') }}" class="flex">
    <x-text-input type="text" name="search" placeholder="Zoek contactformulier" value="{{ request()->query('search') }}"/>
    <x-primary-button type="submit" class="self-stretch">Zoek</x-primary-button>
</form>

<table>
    <thead>
        <tr>
            <th>Bestelnummer</th>
            <th>Koper</th>
            <th>Email</th>
            <th>Adres</th>
            <th>Telefoonnummer</th>
            <th>Datum</th>
            <th>Artikelen</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($orders as $order)
            <tr>
                <td>{{ '#' . $order->order_nr}}</td>
                <td>{{ ucwords($order->lastname) . " " . ucwords($order->firstname) }}</td>
                <td>{{ $order->email }}</td>
                <td>{{ $order->street . " " . $order->streetnr . ", " . $order->zip . " " . $order->city }}</td>
                <td>{{ $order->phone }}</td>
                <td>{{ $order->created_at->format('d/m/Y (H:i)') }}</td>
                <td><button class="myButton" data-target="#message-{{ $loop->index }}">Zie bestelling <i class="arrow right"></i></button></td>
            </tr>

            <tr id="message-{{ $loop->index }}">
                <td colspan="7">
                    @foreach ($order->orderProducts as $orderProduct)
                        <p>{{ $orderProduct }} }}</p>
                    @endforeach
                </td>
            </tr>
        @empty

        @endforelse
    </tbody>
</table>

@foreach ($test as $order)
    @foreach ($order->products as $product)
        <!-- Display product details here -->
        <p>{{ $product->name }} - {{ $product->pivot->quantity }}</p>
    @endforeach
@endforeach

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
$(document).ready(function() {
    $('.myButton').on('click', function() {
        var target = $(this).data('target');
        $(target).toggle();
    });
});
</script>
@endsection