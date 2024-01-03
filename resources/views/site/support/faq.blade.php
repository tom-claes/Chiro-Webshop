@extends('layouts.app')

@section('title', 'Chiro Zuun Webshop')

@section('content')
<div class="category-banner">
    <h2 class="category-title">FAQ categorie: {{ $faqCategory }}</h2>
</div>
    <div class="support-page">
        @forelse ($faqs as $faq)
            <div class="support-box">
                <p>{{ $faq->question }}</p>
                <button class="myButton"><i class="arrow right"></i></button>
                <div class="myText" style="display: none;">
                    <p class="faq-answer">{{ $faq->answer }}</p>
                </div>
            </div>
        @empty
            <p>Er zijn nog geen FAQ's aangemaakt</p>
        @endforelse
    </div>
    
@endsection