@extends('layouts.app')

@section('title', 'Chiro Zuun Webshop')

@section('content')
<div class="category-banner">
    <h2 class="category-title">Contact</h2>
</div>
        <div class="support-page">
            <p class="admin-form-heading">Neem contact op met Chiro Zuun</p>

            <Form method="POST" action="{{ route('support.contact') }}" enctype="multipart/form-data">
                @csrf

                <div style="display: flex; justify-content: space-between; width: 100%;">
                    <div class="form-div" style="width: 48%;">
                        <x-input-label for="firstname" :value="__('Voornaam')" />
                        <x-text-input id="firstname" class="block mt-1 w-full" type="text" name="firstname" :value="old('firstname')" required autofocus autocomplete="firstname" />
                        <x-input-error :messages="$errors->get('firstname')" class="mt-2" />
                    </div>
                    
                    <div class="form-div" style="width: 48%;">
                        <x-input-label for="lastname" :value="__('Acthernaam')" />
                        <x-text-input id="lastname" class="block mt-1 w-full" type="text" name="lastname" :value="old('lastname')" required autofocus autocomplete="lastname" />
                        <x-input-error :messages="$errors->get('lastname')" class="mt-2" />
                    </div>
                </div>

                <div class="form-div">
                    <x-input-label for="email" :value="__('E-mail')" />
                    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="email" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <div class="form-div">
                    <x-input-label for="subject" :value="__('Onderwerp')" />
                    <x-text-input id="subject" class="block mt-1 w-full" type="text" name="subject" :value="old('subject')" required autofocus autocomplete="subject" />
                    <x-input-error :messages="$errors->get('subject')" class="mt-2" />
                </div>

                <div class="form-div">
                    <x-input-label for="message" :value="__('Bericht')" />
                    <x-textarea id="message" class="block mt-1 w-full" name="message" autofocus autocomplete="message">{{ old('message') }}</x-textarea>
                    <x-input-error :messages="$errors->get('message')" class="mt-2" />
                </div>

                <x-primary-button class="admin-form-btn">
                    {{ __('Verstuur') }}
                </x-primary-button>
            </Form>
        </div>
    


@endsection