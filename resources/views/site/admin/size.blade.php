@extends('layouts.admin')

@section('title', 'Chiro Zuun Webshop')

@section('content')

    <div class="admin-create">
        <p class="admin-form-heading">Voeg een maat categorie toe aan de catalogus (bv. Kinderen of Volwassenen)</p>

        <Form method="POST" action="{{ route('admin.size.sort') }}">
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

    <br> <br>

    <div class="admin-create">
        <p class="admin-form-heading">Voeg een maat aan een maat categorie toe</p>

        <Form method="POST" action="{{ route('admin.size.size') }}" enctype="multipart/form-data">
            @csrf
            
            <div class="form-div">
                <x-input-label for="size_sort" :value="__('Behoort tot maat categorie')" />
                <x-dropdown-form id="size_sort" name="size_sort" class="block mt-1 w-full" required autofocus autocomplete="size_sort">
                    <option disabled selected></option>
            
                    @foreach($size_sorts as $size_sort)
                        <option value="{{ $size_sort->id }}">{{ $size_sort->name }}</option>
                    @endforeach
                </x-dropdown-form>
                <x-input-error :messages="$errors->get('size_sort')" class="mt-2" />
            </div>

            <div class="form-div">
                <x-input-label for="size" :value="__('Naam maat')" />
                <x-text-input id="size" class="block mt-1 w-full" type="text" name="size" :value="old('size')" required autofocus autocomplete="size" />
                <x-input-error :messages="$errors->get('size')" class="mt-2" />
            </div>

            <x-primary-button class="admin-form-btn">
                {{ __('Creëer Maat') }}
            </x-primary-button>
        </Form>
    
    </div>

    <div class="admin-show-table">
        <div class="admin-show-nav">
            <p>Afbeelding</p>
            <p>Naam product</p>
            <p>Beschrijving</p>
            <p>Soort maat</p>
            <p>Prijs</p>
        </div>
        @foreach($categories as $category)
            <h2>{{ $category->name }}</h2>
            
            @foreach($category->products as $product)
            <div class="admin-inline-items">
                <img class="admin-show-img" src="{{ asset('storage/' . $product->img) }}" alt="{{ $product->name }}">
                <div class="product-details">
                    <p>{{$product->name}}</p>
                    <p>{{ $product->description }}</p>
                    <p>{{ $product->size_sort }}</p>
                    <p>{{ "€" . $product->price }}</p>
                <div class="product-details">
            </div>  
            @endforeach
        @endforeach
    </div>
@endsection
