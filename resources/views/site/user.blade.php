@extends('layouts.site')

@section('content')


<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
        <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
            <div class="max-w-xl">
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
                    
                        <form method="POST" action="{{ route('user.update') }}" class="mt-6 space-y-6">
                            @csrf

                            <div>
                                <x-input-label for="pictures" :value="__('Pictures')" />

                                <x-input-error class="mt-2" :messages="$errors->get('pictures')" />
                            </div>
                            
                            <div>
                                <x-input-label for="bio" :value="__('Bio')" />
                                <x-textarea id="bio" name="bio" type="text" class="mt-1 block w-full" required autofocus autocomplete="text">{{old('bio', $user_info->bio ?? '')}}</x-textarea>
                                <x-input-error class="mt-2" :messages="$errors->get('bio')" />
                            </div>

                            <div>
                                <x-input-label for="residence" :value="__('City')" />
                                <x-text-input id="residence" name="residence" type="text" class="mt-1 block w-full" :value="old('residence', )" required autofocus autocomplete="text" />
                                <x-input-error class="mt-2" :messages="$errors->get('residence')" />
                            </div>

                            <div>
                                <x-input-label for="language" :value="__('Speaks Languages')" />
                                <x-text-input id="language" name="language" type="text" class="mt-1 block w-full" :value="old('language')" required autofocus autocomplete="text" />
                                <x-input-error class="mt-2" :messages="$errors->get('language')" />
                            </div>

                            <div>
                                <x-input-label for="pet" :value="__('Has Pets')" />
                                <x-text-input id="pet" name="pet" type="text" class="mt-1 block w-full" :value="old('pet')" autofocus autocomplete="text" />
                                <x-input-error class="mt-2" :messages="$errors->get('pet')" />
                            </div>

                            <div>
                                <x-input-label for="hobby" :value="__('Hobbies')" />
                                <x-text-input id="hobby" name="hobby" type="text" class="mt-1 block w-full" :value="old('hobby')" autofocus autocomplete="text" />
                                <x-input-error class="mt-2" :messages="$errors->get('hobby')" />
                            </div>

                            <div>
                                <x-input-label for="interest" :value="__('Interests')" />
                                <x-text-input id="interest" name="interest" type="text" class="mt-1 block w-full" :value="old('interest', $user_info->interest ?? '')" autofocus autocomplete="text" />
                                <x-input-error class="mt-2" :messages="$errors->get('interest')" />
                            </div>
                        
                            <div>
                                <x-input-label for="toy" :value="__('Favourite Toy')" />
                                <x-text-input id="toy" name="toy" type="text" class="mt-1 block w-full" :value="old('toy', $user_info->toy ?? '')" autofocus autocomplete="text" />
                                <x-input-error class="mt-2" :messages="$errors->get('toy')" />
                            </div>
                        
                            <div>
                                <x-input-label for="food" :value="__('Favourite food')" />
                                <x-text-input id="food" name="food" type="text" class="mt-1 block w-full" :value="old('food', $user_info->food ?? '')" autofocus autocomplete="text" />
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
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('js/app.js') }}"></script>

@endsection