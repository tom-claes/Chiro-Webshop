@extends('layouts.admin')

@section('title', 'Chiro Zuun Webshop')

@section('content')
<p class="admin-form-heading">Edit maat</p>

<Form method="POST" action="{{ route('admin.size.edit.size', $size->id) }}">
    @csrf
    @method('PUT')
    <div class="form-div">
        <x-input-label for="size" :value="__('Naam maat')" />
        <x-text-input id="size" class="block mt-1 w-full" type="text" name="size" :value="old('size', ucwords($size->size))" required autofocus autocomplete="size" />
        <x-input-error :messages="$errors->get('size')" class="mt-2" />
    </div>
    <x-primary-button class="admin-form-btn">
        {{ __('Update maat') }}
    </x-primary-button>
</Form>

@endsection