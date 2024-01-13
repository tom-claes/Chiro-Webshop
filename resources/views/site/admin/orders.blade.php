@extends('layouts.admin')

@section('title', 'Chiro Zuun Webshop')

@section('content')
<p class="admin-heading">Bestellingen</p>

<form method="GET" action="{{ route('admin.orders') }}" class="flex">
    <x-text-input type="text" name="search" placeholder="Zoek bestelling" value="{{ request()->query('search') }}"/>
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
            <th>Prijs</th>
            <th>Datum</th>
            <th>Artikelen</th>
            <th></th>
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
                <td>{{ "€" . number_format($order->total_price, 2)}}</td>
                <td>{{ $order->created_at->format('d/m/Y (H:i)') }}</td>
                <td><button class="myButton" data-target="#message-{{ $loop->iteration }}">Zie bestelling <i class="arrow right"></i></button></td>
                <td>
                    <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            &#x22EE;
                        </button>
                        <ul class="dropdown-menu">
                        <li><form method="POST" action="{{ route('admin.delete.order', $order->order_nr) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="dropdown-item delete">Verwijder</button>
                            </form></li>
                        </ul>
                    </div>
                </td>
        </tr>
        <tr id="message-{{ $loop->iteration }}" style="display: none;">
            <td colspan="9">
                @foreach ($order->products as $item)
                    <p> 
                        <span class="bold">Item: </span>{{ $item->name}} 
                        <span class="bold">Maat: </span>{{ $item->pivot->size->size . " (" . $item->sizeSort->name . ")" }}
                        <span class="bold">Aantal: </span>{{$item->pivot->quantity}}
                    </p>
                @endforeach
            </td>
        </tr>

            
        @empty

        @endforelse
    </tbody>
</table>

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