@extends('layouts.admin')

@section('title', 'Chiro Zuun Webshop')

@section('content')
<div class="admin-create">
    <p class="admin-form-heading">Users</p>
    
    <div class="admin-show-table">
        <div class="admin-show-nav">

        </div>
        
        @forelse ($users as $user)
            <p>{{ $user->lastname . " " . $user->firstname}}</p>
            <p>{{ $user->email }}</p>
            <p>{{ $user->admin }}</p>
            @if( $user->admin == 1)
                <p>Ja</p>
            @else
                <p>Nee</p>
            @endif
            
            <p>{{ $user->username }}</p>
            <p>{{ $user->birthdate }}</p>
            <img class="admin-show-img" src="{{ asset('storage/' . $user->img) }}" alt="Profiel foto">
            <p>{{ $user->bio }}</p>
        @empty
            
        @endforelse
    </div>

</div>
@endsection