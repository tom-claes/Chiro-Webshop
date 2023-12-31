@extends('layouts.admin')

@section('title', 'Chiro Zuun Webshop')

@section('content')
<div class="admin-create">
    <p class="admin-form-heading">Contact</p>
    <div class="admin-show-table">
        <div class="admin-show-nav">

        </div>
        
        @forelse ($contact as $item)
            <p>{{ $item->lastname . " " . $item->firstname}}</p>
            <p>{{ $item->subject }}</p>
            <p>{{ $item->created_at->format('H:i - d/m/Y')}}</p>
        @empty
            <p>No new contact requests</p>
        @endforelse
    </div>
</div>
@endsection