@extends('layouts.admin')

@section('title', 'Chiro Zuun Webshop')

@section('content')

    <div class="admin-create">
        <p class="admin-form-heading">Maak een nieuwe categorie aan</p>

        <Form method="POST" action="{{ route('admin.categories') }}">
            @csrf

            <div class="form-div">
                <x-input-label for="name" :value="__('Naam categorie')" />
                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <x-primary-button class="admin-form-btn">
                {{ __('Creëer categorie') }}
            </x-primary-button>
        </Form>
    
    </div>
@endsection