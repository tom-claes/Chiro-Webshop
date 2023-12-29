@extends('layouts.admin')

@section('title', 'Chiro Zuun Webshop')

@section('content')
<p class="admin-form-heading">{{$user->firstname . " " . $user->lastname}}</p>

<img class="admin-show-img" src="{{ asset('storage/' . $user->img) }}" alt="Profiel foto">
<p>{{$user->username}}</p>
<p>{{$user->birthdate}}</p>
<p>{{$user->bio}}</p>
<p>{{$user->email}}</p>
<p>{{$user->admin}}</p>
    
@endsection