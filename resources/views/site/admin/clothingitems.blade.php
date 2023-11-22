@extends('layouts.admin')

@section('title', 'Chiro Zuun Webshop')

@section('content')

    <div class="admin-create">
        <p class="admin-form-heading">Voeg een kledingstuk toe aan de catalogus</p>

        <Form method="POST" action="{{ route('admin.categories') }}">
            @csrf

            <div>
                <x-input-label for="name" :value="__('Naam kledingstuk')" />
                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="name" :value="__('Naam kledingstuk')" />
                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            

            <x-primary-button class="admin-form-btn">
                {{ __('Creëer categorie') }}
            </x-primary-button>
        </Form>
    
    </div>
@endsection