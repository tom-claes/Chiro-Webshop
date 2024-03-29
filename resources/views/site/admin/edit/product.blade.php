@extends('layouts.admin')

@section('title', 'Chiro Zuun Webshop')

@section('content')
<p class="admin-heading">Edit product</p>

<Form method="POST" action="{{ route('admin.edit.clothingitem', $product->id) }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="form-div">
        <x-input-label for="name" :value="__('Naam kledingstuk') . '<span class=\'required\'>*</span>'" />
        <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name', ucwords($product->name))" required autofocus autocomplete="name" />
        <x-input-error :messages="$errors->get('name')" class="mt-2" />
    </div>
    
    <div class="form-div">
        <x-input-label for="description" :value="__('Korte beschrijving') . '<span class=\'required\'>*</span>'" />
        <x-textarea id="description" class="block mt-1 w-full" name="description" autofocus autocomplete="description" :value="old('description', ucfirst($product->description))"></x-textarea>
        <x-input-error :messages="$errors->get('description')" class="mt-2" />
    </div>

    <div class="form-div">
        <x-input-label for="size_sort" :value="__('Behoort tot maat categorie') . '<span class=\'required\'>*</span>'" />
        <x-dropdown-form id="size_sort" name="size_sort" class="block mt-1 w-full" required autofocus autocomplete="size_sort">
            @foreach($size_sorts as $size_sort)
                <option value="{{ $size_sort->id }}" {{ $product->sizeSort->id == $size_sort->id ? 'selected' : '' }}>
                    {{ ucwords($size_sort->name) . " (". ucwords($size_sort->type) . ")"  }}
                </option>
            @endforeach
        </x-dropdown-form>
        <x-input-error :messages="$errors->get('size_sort')" class="mt-2" />
    </div>

    <div class="form-div">
        <x-input-label for="category" :value="__('Behoort tot categorie') . '<span class=\'required\'>*</span>'" />
        <x-dropdown-form id="category" name="category" class="block mt-1 w-full" required autofocus autocomplete="category">
            @foreach($categories as $category)
                <option value="{{ $category->id }}" {{ $product->category == $category->id ? 'selected' : '' }}>
                    {{ ucwords($category->name) }}
                </option>
            @endforeach
        </x-dropdown-form>
        <x-input-error :messages="$errors->get('category')" class="mt-2" />
    </div>

    <div class="form-div">
        <x-input-label for="price" :value="__('Prijs') . '<span class=\'required\'>*</span>'" />
        <x-text-input id="price" class="block mt-1 w-full" type="number" name="price" :value="old('price', $product->price)" required autofocus autocomplete="price" />
        <x-input-error :messages="$errors->get('price')" class="mt-2" />
    </div>

    <div class="form-div">
        <x-input-label for="img" :value="__('Upload afbeelding')" />
        <img class="admin-show-img" src="{{ asset($product->img) }}" alt="{{ $product->name }}">
        <x-file-input id="img" name="img" :value="old('img')" autofocus autocomplete="img" />
    </div>
    <x-primary-button class="admin-form-btn">
        {{ __('Update kledingstuk') }}
    </x-primary-button>
</Form>

@endsection