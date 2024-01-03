@extends('layouts.admin')

@section('title', 'Chiro Zuun Webshop')

@section('content')
<table>
    <thead>
        <tr>
            <th>Product</th>
            <th>Product Categorie</th>
            <th>Soort Maat</th>
            <th>Prijs</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @forelse ($products as $product)
            <tr>
                <td>{{ $product->name }}</td>
                <td>{{ $product->productcategory->name }}</td>
                <td>{{ $product->sizeSort->name }}</td>
                <td>{{ '€' . $product->price }}</td>
                <td>
                    <a href="{{route('admin.stock', $product->id)}}" style="display: flex; align-items: center;">
                        Pas stock aan
                        <img style="vertical-align: middle; margin-left: 6px;" width="13.75px" src="{{ asset('IMG\link.svg') }}" alt="Your SVG File">
                    </a>
                </td>
            </tr>
        @empty
        @endforelse
    </tbody>
</table>
@endsection