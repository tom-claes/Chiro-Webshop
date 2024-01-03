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
                            <a href="{{ route('support.faq', $category->id) }}">{{ $category->name }}</a>
                        </td>
                    </tr>
                @empty
            
                @endforelse
            </tbody>
        </table>
    </div>
@endsection