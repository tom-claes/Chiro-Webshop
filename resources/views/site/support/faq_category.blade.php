@extends('layouts.app')

@section('title', "FAQ's")

@section('content')

<div class="category-banner">
    <h2 class="category-title">FAQ Categoriën</h2>
</div>

    <div class="support-page">

        <table>
            <tbody>
                @forelse ($faqCategories as $category)
                    <tr>
                        <td class="faq-category">
                            <a href="{{ route('support.faq', $category->id) }}">{{ ucwords($category->name) }}</a>
                        </td>
                    </tr>
                @empty
                    <div class="empty">Er zijn nog geen FAQ categoriën beschikbaar!</div>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection