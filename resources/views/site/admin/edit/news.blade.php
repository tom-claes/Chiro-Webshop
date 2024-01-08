@extends('layouts.admin')

@section('title', 'Chiro Zuun Webshop')

@section('content')
<p class="admin-heading">Edit Nieuws post</p>

<Form method="POST" action="{{ route('admin.update.newsitem', $news->id) }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="form-div">
        <x-input-label for="title" :value="__('Titel') . '<span class=\'required\'>*</span>'" />
        <x-text-input id="title" class="block mt-1 w-full" type="text" name="title" :value="old('title', ucfirst($news->title))" required autofocus autocomplete="title" />
        <x-input-error :messages="$errors->get('title')" class="mt-2" />
    </div>
    <div class="form-div">
        <x-input-label for="content" :value="__('Bericht') . '<span class=\'required\'>*</span>'" />
        <x-textarea id="content" class="block mt-1 w-full" name="content" :value="old('content', ucfirst($news->content))" autofocus autocomplete="content"></x-textarea>
        <x-input-error :messages="$errors->get('content')" class="mt-2" />
    </div>

    <div class="form-div">
        <x-input-label for="img" :value="__('Upload afbeelding')" />
        <img class="admin-show-img" src="{{ asset($news->img) }}" alt="">
        <x-file-input id="img" name="img" label="Upload afbeelding" :value="old('img')"  autofocus autocomplete="img" />
    </div>
    <x-primary-button class="admin-form-btn">
        {{ __('Update post') }}
    </x-primary-button>
</Form>

@endsection