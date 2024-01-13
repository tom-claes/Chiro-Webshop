@extends('layouts.admin')

@section('title', 'Chiro Zuun Webshop')

@section('content')
<p class="admin-heading">Maten</p>

    <div class="admin-create">
        <p class="admin-form-heading">Voeg een maat categorie toe aan de catalogus</p>
        <button class="myButton"><i class="arrow right"></i></button>

        <div class="myText" style="display: none;">
            <Form method="POST" action="{{ route('admin.size.sort') }}">
                @csrf
                <div class="form-div">
                    <x-input-label for="name" :value="__('Naam categorie') . '<span class=\'required\'>*</span>'" />
                    <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" placeholder="Bv. Kinderen, Volwassenen" required autofocus autocomplete="name" />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <div class="form-div">
                    <x-input-label for="type" :value="__('Type maat') . '<span class=\'required\'>*</span>'" />
                    <x-text-input id="type" class="block mt-1 w-full" type="text" name="type" :value="old('type')" placeholder="Bv. Broeken, T-shirts, Maten,..." required autofocus autocomplete="type" />
                    <x-input-error :messages="$errors->get('type')" class="mt-2" />
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
                    <x-input-label for="size_sort" :value="__('Behoort tot maat categorie') . '<span class=\'required\'>*</span>'" />
                    <x-dropdown-form id="size_sort" name="size_sort" class="block mt-1 w-full" required autofocus autocomplete="size_sort">
                        <option disabled selected></option>
            
                        @foreach($size_sorts as $size_sort)
                            <option value="{{ $size_sort->id }}">{{ ucwords($size_sort->name) . " (" . ucwords($size_sort->type) . ")"}}</option>
                        @endforeach
                    </x-dropdown-form>
                    <x-input-error :messages="$errors->get('size_sort')" class="mt-2" />
                </div>
                <div class="form-div">
                    <x-input-label for="size" :value="__('Naam maat') . '<span class=\'required\'>*</span>'" />
                    <x-text-input id="size" class="block mt-1 w-full" type="text" name="size" :value="old('size')" placeholder="Bv. XS, S, M, L, XL,..." required autofocus autocomplete="size" />
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
                <th></th>   
            </tr>
        </thead>
        
        @foreach($size_sorts as $size_sort)
        <tr>
            <td class="table-subtitle-row">
                <p class="table-subtitle">Maat Categorie: {{ ucwords($size_sort->name) . " (". ucwords($size_sort->type) . ")"}}</p>
            </td>
            <td class="table-subtitle-row">
                <div class="dropdown ">
                    <button class="btn btn-secondary dropdown-toggle dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        &#x22EE;
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{route('admin.size.edit.sizesort', $size_sort->id)}}">Edit</a></li>
                        <li>
                            <form method="POST" action="{{ route('admin.delete.sizesort', $size_sort->id) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="dropdown-item delete">Verwijder</button>
                            </form>
                        </li>
                    </ul>
                </div>
            </td>
        </tr>
            
            @foreach($size_sort->sizes as $size)
                <tr>
                    <td>{{$size->size}}</td>
                    <td>
                        <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                &#x22EE;
                            </button>
                            <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{route('admin.size.edit.size', $size->id)}}">Edit</a></li>
                            <li><form method="POST" action="{{ route('admin.delete.size', $size->id) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="dropdown-item delete">Verwijder</button>
                                </form></li>
                            </ul>
                        </div>
                    </td>
                </tr>
            @endforeach
        @endforeach
    </table>
@endsection
