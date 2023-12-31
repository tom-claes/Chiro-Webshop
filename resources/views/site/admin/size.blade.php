@extends('layouts.admin')

@section('title', 'Chiro Zuun Webshop')

@section('content')

    <div class="admin-create">
        <p class="admin-form-heading">Voeg een maat categorie toe aan de catalogus (bv. Kinderen of Volwassenen)</p>
        <button class="myButton"><i class="arrow right"></i></button>

        <div class="myText" style="display: none;">
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

    </div>

    <br> <br>

    <div class="admin-create">
        <p class="admin-form-heading">Voeg een maat aan een maat categorie toe</p>
        <button class="myButton"><i class="arrow right"></i></button>

        <div class="myText" style="display: none;">
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
    
    </div>

    <table>
        <thead>
            <tr>
                <th>Maat per maatsoort</th>   
            </tr>
        </thead>
        
        @foreach($size_sorts as $size_sort)
            <tr>
                <td colspan="5" class="table-subtitle-row">
                    <p class="table-subtitle">Maat Categorie: {{ $size_sort->name }}</p>
                </td>
            </tr>
            
            @foreach($size_sort->sizes as $size)
                <tr>
                    <td>{{$size->size}}</td>
                </tr>
            @endforeach
        @endforeach
    </table>
@endsection
