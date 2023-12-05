@extends('layouts.app')

@section('title', 'Chiro Zuun Webshop')
    
@section('header', 'Homepage')

@section('content')

    <p class="admin-form-heading">Voeg een kledingstuk toe aan de catalogus</p>

    <Form method="POST" action="{{ route('admin.clothingitems') }}" enctype="multipart/form-data">
        @csrf

        
        <div class="form-div">
            <x-input-label for="name" :value="__('Naam kledingstuk')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <div class="form-div">
            <x-input-label for="description" :value="__('Korte beschrijving')" />
            <x-textarea id="description" class="block mt-1 w-full" name="description" autofocus autocomplete="description">{{ old('description') }}</x-textarea>
            <x-input-error :messages="$errors->get('description')" class="mt-2" />
        </div>


        <div class="form-div">
            <x-input-label for="size_sort" :value="__('Type maat')" />
            <x-dropdown-form id="size_sort" name="size_sort" class="block mt-1 w-full" required autofocus autocomplete="name">
                <option disabled selected></option> <!-- Zorgt voor een lege selectie bij laden van de pagina, maar het is ook geen geldige optie om in te dienen-->
                <option value="Kinderen">Kinderen</option>
                <option value="Volwassenen">Volwassenen</option>
            </x-dropdown-form>
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>
        
        <div class="form-div">
            <x-input-label for="category" :value="__('Behoort tot categorie')" />
            <x-dropdown-form id="category" name="category" class="block mt-1 w-full" required autofocus autocomplete="category">
                <option disabled selected></option>
        
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </x-dropdown-form>
            <x-input-error :messages="$errors->get('category')" class="mt-2" />
        </div>

        <div class="form-div">
            <x-input-label for="price" :value="__('Prijs')" />
            <x-text-input id="price" class="block mt-1 w-full" type="number" name="price" :value="old('price')" required autofocus autocomplete="price" />
            <x-input-error :messages="$errors->get('price')" class="mt-2" />
        </div>
        

        
        <x-file-input id="img" name="img" label="Upload afbeelding" :value="old('img')" required autofocus autocomplete="img" />

        <x-primary-button class="admin-form-btn">
            {{ __('Creëer kledingstuk') }}
        </x-primary-button>
    </Form>


@endsection