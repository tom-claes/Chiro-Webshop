@extends('layouts.admin')

@section('title', 'Chiro Zuun Webshop')

@section('content')
<p class="admin-heading">Catalogus</p>

    <div class="admin-create">
        <p class="admin-form-heading">Voeg een categorie toe aan de catalogus</p>
        <button class="myButton"><i class="arrow right"></i></button>

        <div class="myText" style="display: none;">
            <Form method="POST" action="{{ route('admin.category') }}">
                @csrf
                <div class="form-div">
                    <x-input-label for="name" :value="__('Naam categorie') . '<span class=\'required\'>*</span>'" />
                    <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" placeholder="Bv. T-shirts, Truien, Bermuda's,..." required autofocus autocomplete="name" />
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
        <p class="admin-form-heading">Voeg een kledingstuk toe aan de catalogus</p>
        <button class="myButton"><i class="arrow right"></i></button>

        <div class="myText" style="display: none;">
            <Form method="POST" action="{{ route('admin.clothingitems') }}" enctype="multipart/form-data">
                @csrf
            
                <div class="form-div">
                    <x-input-label for="name" :value="__('Naam kledingstuk') . '<span class=\'required\'>*</span>'" />
                    <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" placeholder="Gele Zuunman T-shirt, Chiro Short,..." required autofocus autocomplete="name" />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>
                <div class="form-div">
                    <x-input-label for="description" :value="__('Korte beschrijving') . '<span class=\'required\'>*</span>'" />
                    <x-textarea id="description" class="block mt-1 w-full" name="description" autofocus autocomplete="description">{{ old('description') }}</x-textarea>
                    <x-input-error :messages="$errors->get('description')" class="mt-2" />
                </div>
            
                <div class="form-div">
                    <x-input-label for="size_sort" :value="__('Behoort tot maat categorie') . '<span class=\'required\'>*</span>'" />
                    <x-dropdown-form id="size_sort" name="size_sort" class="block mt-1 w-full" required autofocus autocomplete="size_sort">
                        <option disabled selected></option>
            
                        @foreach($size_sorts as $size_sort)
                            <option value="{{ $size_sort->id }}">{{ ucwords($size_sort->name) . " (". ucwords($size_sort->type) . ")" }}</option>
                        @endforeach
                    </x-dropdown-form>
                    <x-input-error :messages="$errors->get('size_sort')" class="mt-2" />
                </div>
                <div class="form-div">
                    <x-input-label for="category" :value="__('Behoort tot categorie') . '<span class=\'required\'>*</span>'" />
                    <x-dropdown-form id="category" name="category" class="block mt-1 w-full" required autofocus autocomplete="category">
                        <option disabled selected></option>
            
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ ucwords($category->name) }}</option>
                        @endforeach
                    </x-dropdown-form>
                    <x-input-error :messages="$errors->get('category')" class="mt-2" />
                </div>
                <div class="form-div">
                    <x-input-label for="price" :value="__('Prijs') . '<span class=\'required\'>*</span>'" />
                    <x-text-input id="price" class="block mt-1 w-full" type="number" name="price" :value="old('price')" required autofocus autocomplete="price" />
                    <x-input-error :messages="$errors->get('price')" class="mt-2" />
                </div>
            
            
                <div class="form-div">
                    <x-input-label for="img" :value="__('Upload afbeelding') . '<span class=\'required\'>*</span>'" />
                    <x-file-input id="img" name="img" :value="old('img')" required autofocus autocomplete="img" />
                </div>
                <x-primary-button class="admin-form-btn">
                    {{ __('Creëer kledingstuk') }}
                </x-primary-button>
            </Form>
        </div>
    
    </div>

    <table>
        <thead>
            <tr>
                <th>Afbeelding</th>
                <th>Naam product</th>
                <th>Beschrijving</th>
                <th>Soort maat</th>
                <th>Prijs</th>
                <th></th>
            </tr>
        </thead>
        
        @foreach($categories as $category)
            <tr>
                <td colspan="5" class="table-subtitle-row">
                    <p class="table-subtitle">Categorie: {{ ucwords($category->name) }}</p>
                </td>
                <td class="table-subtitle-row">
                    <div class="dropdown ">
                        <button class="btn btn-secondary dropdown-toggle dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            &#x22EE;
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('admin.edit.category', $category->id)}}">Edit</a></li>
                            <li>
                                <form method="POST" action="{{ route('admin.delete.productcategory', $category->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="dropdown-item delete">Verwijder</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </td>
            </tr>
            
            @foreach($category->products as $product)
                <tr>
                    <td><img class="admin-show-img" src="{{ asset($product->img) }}" alt="{{ $product->name }}"></td>    
                    <td>{{ucwords($product->name)}}</td>
                    <td>{{ ucfirst($product->description) }}</td>
                    <td>{{ ucwords($product->sizeSort->name) . " (". ucwords($product->sizeSort->type) . ")" }}</td>
                    <td>{{ "€" . $product->price }}</td>

                    <td>
                        <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                &#x22EE;
                            </button>
                            <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('admin.edit.clothingitem', $product->id)}}">Edit</a></li>
                            <li><form method="POST" action="{{ route('admin.delete.product', $product->id) }}">
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
