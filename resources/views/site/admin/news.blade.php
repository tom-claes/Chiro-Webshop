@extends('layouts.admin')

@section('title', 'Chiro Zuun Webshop')

@section('content')

    <div class="admin-create">
        <p class="admin-form-heading">Maak een Nieuws post aan</p>

        <Form method="POST" action="{{ route('admin.news') }}" enctype="multipart/form-data">
            @csrf

            
            <div class="form-div">
                <x-input-label for="title" :value="__('Titel')" />
                <x-text-input id="title" class="block mt-1 w-full" type="text" name="title" :value="old('title')" required autofocus autocomplete="title" />
                <x-input-error :messages="$errors->get('title')" class="mt-2" />
            </div>

            <div class="form-div">
                <x-input-label for="content" :value="__('Bericht')" />
                <x-textarea id="content" class="block mt-1 w-full" name="content" autofocus autocomplete="content">{{ old('content') }}</x-textarea>
                <x-input-error :messages="$errors->get('content')" class="mt-2" />
            </div>

            <x-file-input id="img" name="img" label="Upload afbeelding" :value="old('img')"  autofocus autocomplete="img" />

            <x-primary-button class="admin-form-btn">
                {{ __('Creëer post') }}
            </x-primary-button>
        </Form>
    
    </div>
    
    
    <table>
        <thead>
            <tr>
                <th>Afbeelding</th>
                <th>Titel</th>
                <th>Bericht</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($news as $item)
                <tr>
                    <td><img class="admin-show-img" src="{{ asset('storage/' . $item->img) }}" alt="Afbeelding van: {{ $item->title }}"></td>
                    <td>{{ $item->title }}</td>
                    <td>{{ $item->content }}</td>
                </tr>
            @empty
            
            @endforelse
        </tbody>
    </table>
    
@endsection
