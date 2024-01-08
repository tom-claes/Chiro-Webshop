@extends('layouts.admin')

@section('title', 'Chiro Zuun Admin')

@section('content')

    <div class="admin-create">
        <p class="admin-form-heading">Maak een nieuwe FAQ categorie aan</p>
        <button class="myButton"><i class="arrow right"></i></button>

        <div class="myText" style="display: none;">
            <Form method="POST" action="{{ route('admin.faq.post.category') }}">
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
        <p class="admin-form-heading">Maak een nieuwe FAQ aan</p>
        <button class="myButton"><i class="arrow right"></i></button>

        <div class="myText" style="display: none;">
            <Form method="POST" action="{{ route('admin.faq.post.item') }}">
                @csrf
                <div class="form-div">
                    <x-input-label for="category" :value="__('Behoort tot categorie')" />
                    <x-dropdown-form id="category" name="category" class="block mt-1 w-full" required autofocus autocomplete="category">
                        <option disabled selected></option>
            
                        @foreach($faqCategories as $category)
                            <option value="{{ $category->id }}">{{ ucwords($category->name) }}</option>
                        @endforeach
                    </x-dropdown-form>
                    <x-input-error :messages="$errors->get('category')" class="mt-2" />
                </div>
                <div class="form-div">
                    <x-input-label for="question" :value="__('Vraag')" />
                    <x-textarea id="question" class="block mt-1 w-full" name="question" required autofocus autocomplete="question">{{ old('question') }}</x-textarea>
                    <x-input-error :messages="$errors->get('question')" class="mt-2" />
                </div>
            
                <div class="form-div">
                    <x-input-label for="answer" :value="__('Antwoord')" />
                    <x-textarea id="answer" class="block mt-1 w-full" name="answer" required autofocus autocomplete="answer">{{ old('answer') }}</x-textarea>
                    <x-input-error :messages="$errors->get('answer')" class="mt-2" />
                </div>
                <x-primary-button class="admin-form-btn">
                    {{ __('Creëer Item') }}
                </x-primary-button>
            </Form>
        </div>

        
    
    </div>

    <table>
        <thead>
            <tr>
                <th>Vraag</th>   
                <th>Antwoord</th>
                <th></th>
            </tr>
        </thead>
        @foreach($faqCategories as $category)
            <tr>
                <td colspan="2" class="table-subtitle-row">
                    <p class="table-subtitle">FAQ Categorie: {{ ucwords($category->name) }}</p>
                </td>
                <td class="table-subtitle-row">
                    <div class="dropdown ">
                        <button class="btn btn-secondary dropdown-toggle dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            &#x22EE;
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{route('admin.faq.edit.category', $category->id)}}">Edit</a></li>
                            <li>
                                <form method="POST" action="{{ route('admin.delete.faqcategory', $category->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="dropdown-item delete">Verwijder</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </td>
            </tr>
            
            @foreach($category->faq as $faq)
                <tr>
                    <td>{{ucfirst($faq->question)}}</td>
                    <td>{{ucfirst($faq->answer)}}</td>

                    <td>
                        <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                &#x22EE;
                            </button>
                            <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{route('admin.faq.edit.item', $faq->id)}}">Edit</a></li>
                            <li><form method="POST" action="{{ route('admin.delete.faqitem', $faq->id) }}">
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