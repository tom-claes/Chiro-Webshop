@extends('layouts.app')

@section('title', 'Chiro Zuun Webshop')

@section('content')
<div class="category-banner">
    <h2 class="category-title">Checkout</h2>
</div>
<div class="support-page">
    <form method="POST" action="{{ route('checkout.view.details') }}">
        @csrf

        <div style="display: flex; justify-content: space-between; width: 100%;">
            <div class="form-div" style="width: 48%;">
                <x-input-label for="lastname" :value="__('Acthernaam') . '<span class=\'required\'>*</span>'" />
                <x-text-input id="lastname" class="block mt-1 w-full" type="text" name="lastname" :value="old('lastname')" placeholder="Bv. Doe" required autofocus autocomplete="lastname" />
                <x-input-error :messages="$errors->get('lastname')" class="mt-2" />
            </div>
            
            <div class="form-div" style="width: 48%;">
                <x-input-label for="firstname" :value="__('Voornaam') . '<span class=\'required\'>*</span>'" />
                <x-text-input id="firstname" class="block mt-1 w-full" type="text" name="firstname" :value="old('firstname')" placeholder="Bv. John" required autofocus autocomplete="firstname" />
                <x-input-error :messages="$errors->get('firstname')" class="mt-2" />
            </div>
        </div>

        <div class="form-div">
            <x-input-label for="email" :value="__('E-mail') . '<span class=\'required\'>*</span>'" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" placeholder="Bv. john.doe@gmail.com" required autofocus autocomplete="email" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="form-div">
            <x-input-label for="phone" :value="__('Telefoonnummer') . '<span class=\'required\'>*</span>'" />
            <x-text-input id="phone" class="block mt-1 w-full" type="number" name="phone" :value="old('phone')" placeholder="Bv. 0412 34 56 78" required autofocus autocomplete="phone" />
            <x-input-error :messages="$errors->get('phone')" class="mt-2" />
        </div>

        <div style="display: flex; justify-content: space-between; width: 100%;">
            <div class="form-div" style="width: 48%;">
                <x-input-label for="street" :value="__('Straat') . '<span class=\'required\'>*</span>'" />
                <x-text-input id="street" class="block mt-1 w-full" type="text" name="street" :value="old('street')" placeholder="Bv. Arthur Quintusstraat" required autofocus autocomplete="street" />
                <x-input-error :messages="$errors->get('street')" class="mt-2" />
            </div>
            
            <div class="form-div" style="width: 48%;">
                <x-input-label for="streetnr" :value="__('Straat nummer') . '<span class=\'required\'>*</span>'" />
                <x-text-input id="streetnr" class="block mt-1 w-full" type="number" name="streetnr" :value="old('streetnr')" placeholder="Bv. 1" required autofocus autocomplete="streetnr" />
                <x-input-error :messages="$errors->get('streetnr')" class="mt-2" />
            </div>
        </div>

        <div style="display: flex; justify-content: space-between; width: 100%;">
            <div class="form-div" style="width: 48%;">
                <x-input-label for="city" :value="__('Woonplaats') . '<span class=\'required\'>*</span>'" />
                <x-text-input id="city" class="block mt-1 w-full" type="text" name="city" :value="old('city')" placeholder="Bv. Sint-Pieters-Leeuw" required autofocus autocomplete="city" />
                <x-input-error :messages="$errors->get('city')" class="mt-2" />
            </div>
            
            <div class="form-div" style="width: 48%;">
                <x-input-label for="zip" :value="__('Postcode') . '<span class=\'required\'>*</span>'" />
                <x-text-input id="zip" class="block mt-1 w-full" type="number" name="zip" :value="old('zip')" placeholder="Bv. 1600" required autofocus autocomplete="zip" />
                <x-input-error :messages="$errors->get('zip')" class="mt-2" />
            </div>
        </div>

        <x-primary-button class="admin-form-btn" style="background-color: #F00">
            {{ __('Afrekenen') }}
        </x-primary-button>

    </form>
</div>
@endsection