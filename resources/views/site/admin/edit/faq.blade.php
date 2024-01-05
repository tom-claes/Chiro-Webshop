@extends('layouts.admin')

@section('title', 'Chiro Zuun Webshop')

@section('content')
<p class="admin-form-heading">Edit FAQ post</p>

<Form method="POST" action="{{ route('admin.faq.edit.item', $faqItem->id) }}">
    @csrf
    @method('PUT')
    <div class="form-div">
        <x-input-label for="category" :value="__('Behoort tot categorie')" />
        <x-dropdown-form id="category" name="category" class="block mt-1 w-full" required autofocus autocomplete="category">        
            @foreach($faqCategories as $category)
                <option value="{{ $category->id }}" {{ $faqItem->category == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
            @endforeach
        </x-dropdown-form>
        <x-input-error :messages="$errors->get('category')" class="mt-2" />
    </div>

    <div class="form-div">
        <x-input-label for="question" :value="__('Vraag')" />
        <x-textarea id="question" class="block mt-1 w-full" name="question" required autofocus autocomplete="question" :value="old('question', $faqItem->question)"></x-textarea>
        <x-input-error :messages="$errors->get('question')" class="mt-2" />
    </div>

    <div class="form-div">
        <x-input-label for="answer" :value="__('Antwoord')" />
        <x-textarea id="answer" class="block mt-1 w-full" name="answer" required autofocus autocomplete="answer" :value="old('answer', $faqItem->answer)"></x-textarea>
        <x-input-error :messages="$errors->get('answer')" class="mt-2" />
    </div>
    <x-primary-button class="admin-form-btn">
        {{ __('Update Faq') }}
    </x-primary-button>
</Form>
@endsection