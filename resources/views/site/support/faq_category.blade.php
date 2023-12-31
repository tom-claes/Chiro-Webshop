@extends('layouts.app')

@section('title', "FAQ's")

@section('content')
    <div class="support-page">

        <table>
            <tbody>
                @forelse ($faqCategories as $category)
                    <tr>
                        <td>
                            <a href="{{ route('support.faq', $category->id) }}">{{ $category->name }}</a>
                        </td>
                    </tr>
                @empty
            
                @endforelse
            </tbody>
        </table>
    </div>
@endsection