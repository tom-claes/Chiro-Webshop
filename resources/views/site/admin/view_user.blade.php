@extends('layouts.admin')

@section('title', 'Chiro Zuun Webshop')

@section('content')
<div class="user-page">
    <img class="user-page-img" src="{{ asset($user->img) }}" alt="Profiel foto">
    
    <div class="user-page-info">

        <div class="user-page-field-box" style="display: flex; gap:30px;">
            <div style="flex: 1;">
                <x-input-label :value="__('Achternaam')" />
                <p class="user-page-field">{{$user->lastname}}</p>
            </div>
            <div style="flex: 1;">
                <x-input-label :value="__('Voornaam')" />
                <p class="user-page-field">{{$user->firstname}}</p>
            </div>
        </div>

        <div class="user-page-field-box">
            <x-input-label :value="__('Gebruikersnaam')" />
            <p class="user-page-field">{{$user->username}}</p>
        </div>

        <div class="user-page-field-box">
            <x-input-label :value="__('Geboortedatum')" />
            <p class="user-page-field">{{$user->birthdate}}</p>
        </div>

        <div class="user-page-field-box">
            <x-input-label :value="__('Bio')" />
            <p class="user-page-bigfield">{{$user->bio}}</p>
        </div>

        <div class="user-page-field-box">
            <x-input-label :value="__('Email')" />
            <p class="user-page-field">{{$user->email}}</p>
        </div>

        <div class="user-page-field-box">
            <x-input-label :value="__('Admin')" />
            @if($user->admin == 1)
                <p class="user-page-field">Ja</p>
            @else
                <p class="user-page-field">Nee</p>
            @endif
        </div>

        <div class="user-page-field-box">
            @if($user->admin == 1)
                <form method="POST" action="{{ route('admin.remove.admin', $user->id) }}">
                    @csrf
                    @method('put')
                    <x-primary-button class="user-page-btn">{{ __('Ontneem admin status') }}</x-primary-button>
                </form>
            @else
                <form method="POST" action="{{ route('admin.make.admin', $user->id) }}">
                    @csrf
                    @method('put')
                    <x-primary-button class="user-page-btn">{{ __('Maak admin') }}</x-primary-button>
                </form>
            @endif
            
        </div>
            
    </div>
</div>
    
@endsection