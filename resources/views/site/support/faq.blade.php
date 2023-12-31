@extends('layouts.app')

@section('title', 'Chiro Zuun Webshop')

@section('content')
    <div class="support-page">
        @forelse ($faqs as $faq)
            <div class="faq">
                <p class="faq-question">{{ $faq->question }}</p>
                <p class="faq-answer">{{ $faq->answer }}</p>
            </div>
        @empty
            <p>Er zijn nog geen FAQ's aangemaakt</p>
        @endforelse
    </div>
    
@endsection