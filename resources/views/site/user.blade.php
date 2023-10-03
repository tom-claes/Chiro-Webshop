@extends('layouts.site')

@section('content')


<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
        <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
            <div class="max-w-xl">
                <form method="POST" action="{{ route('user.update') }}">
                    @csrf
                    <section>
                        <header>
                            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                {{ __("Child's Information") }}
                            </h2>
                        
                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                {{ __("Edit profile information other users see when watching your profile") }}
                            </p>
                        </header>
                    
                        <form id="send-verification" method="post" action="{{ route('verification.send') }}">
                            @csrf
                        </form>
                    
                        <form method="post" action="{{ route('user.update') }}" class="mt-6 space-y-6">
                            @csrf
                            @method('patch')

                            <div>
                                <x-input-label for="pictures" :value="__('Pictures')" />

                                <x-input-error class="mt-2" :messages="$errors->get('pictures')" />
                            </div>
                        
                            <div>
                                <x-input-label for="bio" :value="__('Bio')" />
                                <x-textarea id="bio" name="bio" type="text" class="mt-1 block w-full" :value="old('bio')" required autofocus autocomplete="text" />
                                <x-input-error class="mt-2" :messages="$errors->get('bio')" />
                            </div>
                        
                            <div>
                                <x-input-label for="city" :value="__('Lives In')" />
                                <x-text-input id="city" name="city" type="text" class="mt-1 block w-full" :value="old('city')" required autofocus autocomplete="city" />
                                <x-input-error class="mt-2" :messages="$errors->get('city')" />
                            </div>

                            <div>
                                <x-input-label for="languages" :value="__('Speaks Languages')" />
                                <x-text-input id="languages" name="languages" type="text" class="mt-1 block w-full" :value="old('languages')" required autofocus autocomplete="text" />
                                <x-input-error class="mt-2" :messages="$errors->get('languages')" />
                            </div>

                            <div>
                                <x-input-label for="pets" :value="__('Has Pets')" />
                                <x-text-input id="pets" name="pets" type="text" class="mt-1 block w-full" :value="old('pets')" required autofocus autocomplete="text" />
                                <x-input-error class="mt-2" :messages="$errors->get('pets')" />
                            </div>

                            <div>
                                <x-input-label for="hobbies" :value="__('Hobbies')" />
                                <x-text-input id="hobbies" name="hobbies" type="text" class="mt-1 block w-full" :value="old('hobbies')" required autofocus autocomplete="text" />
                                <x-input-error class="mt-2" :messages="$errors->get('hobbies')" />
                            </div>

                            <div>
                                <x-input-label for="interests" :value="__('Interests')" />
                                <x-text-input id="interests" name="interests" type="text" class="mt-1 block w-full" :value="old('interests')" required autofocus autocomplete="text" />
                                <x-input-error class="mt-2" :messages="$errors->get('interests')" />
                            </div>
                        
                            <div>
                                <x-input-label for="toys" :value="__('Favourite Toy')" />
                                <x-text-input id="toys" name="toys" type="text" class="mt-1 block w-full" :value="old('toys')" required autofocus autocomplete="text" />
                                <x-input-error class="mt-2" :messages="$errors->get('toys')" />
                            </div>
                        
                            <div>
                                <x-input-label for="food" :value="__('Favourite food')" />
                                <x-text-input id="food" name="food" type="text" class="mt-1 block w-full" :value="old('food')" required autofocus autocomplete="text" />
                                <x-input-error class="mt-2" :messages="$errors->get('food')" />
                            </div>
                        
                            <div class="flex items-center gap-4">
                                <x-primary-button>{{ __('Save') }}</x-primary-button>
                            
                                @if (session('status') === 'user-updated')
                                    <p
                                        x-data="{ show: true }"
                                        x-show="show"
                                        x-transition
                                        x-init="setTimeout(() => show = false, 2000)"
                                        class="text-sm text-gray-600 dark:text-gray-400"
                                    >{{ __('Saved.') }}</p>
                                @endif
                            </div>
                        </form>
                    </section>
                </form>
            </div>
        </div>
    </div>
</div>


@endsection