<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Profiel Informatie') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __("Werk de profielgegevens en het e-mailadres van je account bij.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div class="profile-picture-container">
            <img class="profile-picture" src="{{asset($user->img)}}" alt="Profiel foto">
            <x-input-label for="img" :value="__('Upload profiel foto')" />
            <x-file-input class="profile-picture-btn" id="img" name="img" label="" autofocus autocomplete="img" />
        </div>

        <div>
            <x-input-label for="lastname" :value="__('Achternaam') . '<span class=\'required\'>*</span>'" />
            <x-text-input id="lastname" name="lastname" type="text" class="mt-1 block w-full" :value="old('lastname', $user->lastname)" required autofocus autocomplete="lastname" />
            <x-input-error class="mt-2" :messages="$errors->get('lastname')" />
        </div>
       
        <div>
            <x-input-label for="firstname" :value="__('Voornaam') . '<span class=\'required\'>*</span>'" />
            <x-text-input id="firstname" name="firstname" type="text" class="mt-1 block w-full" :value="old('firstname', $user->firstname)" required autofocus autocomplete="firstname" />
            <x-input-error class="mt-2" :messages="$errors->get('firstname')" />
        </div>

        <div>
            <x-input-label for="username" :value="__('Gebruikersnaam') . '<span class=\'required\'>*</span>'" />
            <x-text-input id="username" name="username" type="text" class="mt-1 block w-full" :value="old('username', $user->username)" required autofocus autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('username')" />
        </div>

        <div class="mt-4">
            <x-input-label for="birthdate" :value="__('Geboortedatum') . '<span class=\'required\'>*</span>'" />
            <x-text-input id="birthdate" class="block mt-1 w-full" type="date" name="birthdate" :value="old('birthdate', $user->birthdate)" autofocus autocomplete="birthdate" /> <!-- required -->
            <x-input-error :messages="$errors->get('birthdate')" class="mt-2" />
        </div>

        <div class="form-div">
            <x-input-label for="bio" :value="__('Bio')" />
            <x-textarea id="bio" class="block mt-1 w-full" name="bio" :value="old('bio', $user->bio ?? '')" autofocus autocomplete="bio"></x-textarea>
            <x-input-error :messages="$errors->get('bio')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email') . '<span class=\'required\'>*</span>'" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800 dark:text-gray-200">
                        {{ __('Je e-mailadres is niet geverifieerd.') }}

                        <button form="send-verification" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                            {{ __('Klik hier om de verificatiemail opnieuw te versturen.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600 dark:text-green-400">
                            {{ __('Er is een nieuwe verificatielink naar uw e-mailadres verzonden.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Opslaan') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600 dark:text-gray-400"
                >{{ __('Wijzigingen Opgeslaan.') }}</p>
            @endif
        </div>
    </form>
</section>
