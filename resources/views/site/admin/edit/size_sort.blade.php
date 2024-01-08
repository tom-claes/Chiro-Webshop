@extends('layouts.admin')

@section('title', 'Chiro Zuun Webshop')

@section('content')
<p class="admin-form-heading">Edit maat categorie</p>

<Form method="POST" action="{{ route('admin.size.edit.sizesort', $size_sort->id) }}">
    @csrf
    @method('PUT')
    <div class="form-div">
        <x-input-label for="name" :value="__('Naam categorie')" />
        <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name', ucwords($size_sort->name))" required autofocus autocomplete="name" />
        <x-input-error :messages="$errors->get('name')" class="mt-2" />
    </div>

    <div class="form-div">
        <x-input-label for="type" :value="__('Type maat')" />
        <x-text-input id="type" class="block mt-1 w-full" type="text" name="type" :value="old('type', ucwords($size_sort->type))" required autofocus autocomplete="type" />
        <x-input-error :messages="$errors->get('type')" class="mt-2" />
    </div>

    <x-primary-button class="admin-form-btn">
        {{ __('Update maat categorie') }}
    </x-primary-button>
</Form>

@endsection