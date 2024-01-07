@extends('layouts.admin')

@section('title', 'Chiro Zuun Webshop')

@section('content')

    <div class="admin-create">
        <p class="admin-form-heading">Maak een Nieuws post aan</p>
        <button class="myButton"><i class="arrow right"></i></button>

        <div class="myText" style="display: none;">
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
    
    </div>
    
    
    <table>
        <thead>
            <tr>
                <th>Afbeelding</th>
                <th>Titel</th>
                <th>Bericht</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @forelse ($news as $item)
                <tr>
                    <td><img class="admin-show-img" src="{{ asset($item->img) }}" alt="Afbeelding van: {{ $item->title }}"></td>
                    <td>{{ $item->title }}</td>
                    <td>{{ $item->content }}</td>
                    <td>
                        <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                &#x22EE;
                            </button>
                            <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Edit</a></li>
                            <li><form method="POST" action="{{ route('admin.delete.newsitem', $item->id) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="dropdown-item delete">Verwijder</button>
                                </form></li>
                            </ul>
                        </div>
                    </td>

                </tr>
            @empty
            
            @endforelse
        </tbody>
    </table>
    
@endsection
