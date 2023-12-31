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
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
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
            </tr>
        </thead>
        @foreach($faqCategories as $category)
            <tr>
                <td colspan="5" class="table-subtitle-row">
                    <p class="table-subtitle">FAQ Categorie: {{ $category->name }}</p>
                </td>
            </tr>
            
            @foreach($category->faq as $faq)
                <tr>
                    <td>{{$faq->question}}</td>
                    <td>{{$faq->answer}}</td>
                </tr>
            @endforeach
        @endforeach
    </table>

@endsection