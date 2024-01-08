@extends('layouts.app')

@section('title', 'Chiro Zuun Webshop')

@section('content')

<div class="category-banner">
    <h2 class="category-title">Nieuws</h2>
</div>

<div class="support-page">
    @forelse ($news as $item)
    <div class="support-box" >
        <p class="news-title">{{ ucfirst($item->title) }}</p>
        <button class="myButton"><i class="arrow right"></i></button>
        <div class="myText" style="display: none;">
            <div class="news-dropdown">
                <img class="news-img" src="{{ asset( $item->img) }}" alt="{{ 'Foto: ' . $item->title }}">
                <p class="news-content">{{ ucfirst($item->content) }}</p>
            </div>
        </div>
    </div>
    @empty
        <div class="empty">Er zijn nog geen Nieuws items beschikbaar!</div>
    @endforelse
</div>
    
@endsection