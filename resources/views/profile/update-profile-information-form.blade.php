<x-form-section submit="updateProfileInformation">
    <x-slot name="title">
        {{ __('Profile Information') }}
    </x-slot>
                                          
    <x-slot name="description">
        {{ __('Update your account\'s profile information and email address.') }}
    </x-slot>

    <x-slot name="form">

        <!-- Name -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="name" value="{{ __('Name') }}" />
            <x-input id="name" type="text" class="mt-1 block w-full" wire:model="state.name" required autocomplete="name" />
            <x-input-error for="name" class="mt-2" />
        </div>

        <!-- Email -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="email" value="{{ __('Email') }}" />
            <x-input id="email" type="email" class="mt-1 block w-full" wire:model="state.email" required autocomplete="username" />
            <x-input-error for="email" class="mt-2" />

            @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::emailVerification()) && ! $this->user->hasVerifiedEmail())
                <p class="text-sm mt-2 dark:text-white">
                    {{ __('Your email address is unverified.') }}

                    <button type="button" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" wire:click.prevent="sendEmailVerification">
                        {{ __('Click here to re-send the verification email.') }}
                    </button>
                </p>

                @if ($this->verificationLinkSent)
                    <p class="mt-2 font-medium text-sm text-green-600 dark:text-green-400">
                        {{ __('A new verification link has been sent to your email address.') }}
                    </p>
                @endif
            @endif
        </div>

        <!-- Birthday -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="birthday" value="{{ __('Birthday') }}" />
            <x-input id="birthday" type="date" class="mt-1 block w-full" wire:model="state.birthday" />
            <x-input-error for="birthday" class="mt-2" />
        </div>

        <!-- Profile Photo Upload -->
        <div class="col-span-6 sm:col-span-4">
            <div class="col-span-6 sm:col-span-4">
                @if(auth()->user()->profile_photo_path)
                    <!-- Display the current profile photo -->
                    <img src="{{ asset('storage/' . auth()->user()->profile_photo_path) }}" alt="{{ auth()->user()->name }}" class="rounded-full h-20 w-20 object-cover">                @else
                    <!-- Placeholder or default image when the user doesn't have a profile picture -->
                    <svg class="h-20 w-20 rounded-full bg-gray-200 text-gray-500">
                        <!-- Placeholder icon, e.g., initials:   {{ substr(Auth::user()->name, 0, 1) }} -->
                    </svg>
                    
                @endif
            </div>
              <!-- Profile Photo Upload -->
              <div class="col-span-6 sm:col-span-4 mt-4">
                <x-label for="photo" value="{{ __('Profile Photo') }}" />
                <input id="photo" type="file" wire:model="photo" accept="image/*">
                <x-input-error for="photo" class="mt-2" />
            </div>
        </div>

        
        <!-- About Me -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="about_me" value="{{ __('About Me') }}" />
            <textarea id="about_me" class="mt-1 block w-full" wire:model="state.about_me"></textarea>
            <x-input-error for="about_me" class="mt-2" />
        </div>

        <x-slot name="actions">
            <x-action-message class="me-3" on="saved">
                {{ __('Saved.') }}
            </x-action-message>                         

            <x-button wire:click="updateProfileInformation" wire:loading.attr="disabled">
                {{ __('Save') }}
            </x-button>

        </x-slot>
   
    </x-slot>
</x-form-section>
