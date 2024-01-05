@extends('layouts.app')

@section('title', 'Chiro Zuun Webshop')

@section('content')
<div class="category-banner">
    <h2 class="category-title">Winkelkar</h2>
</div>
<div class="support-page">
    @forelse ($cart as $item)
        <p>{{$item->prod}}</p>
    @empty
        
    @endforelse
</div>
@endsection