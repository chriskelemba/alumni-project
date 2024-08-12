<section>
    <header>
        <div class="flex justify-between">
            <div>
                <h2 class="text-lg font-medium text-gray-900">
                    {{ __('Profile Information') }}
                </h2>
        
                <p class="mt-1 text-sm text-gray-600">
                    {{ __("Update your account's profile information and email address.") }}
                </p>
            </div>
            @role('alumni')
            <a href="{{ route('social.edit') }}">
                <x-primary-button>{{ __('Edit Socials') }}</x-primary-button>
            </a>
            @endrole
        </div>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <!-- Email -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        @role('alumni')
        <!-- Phone Number -->
        <div>
            <x-input-label for="phone_number" :value="__('Phone Number')" />
            <x-text-input id="phone_number" name="phone_number" value="{{ old('phone_number', $user->phone_number) }}" class="block mt-1 w-full" />
            <x-input-error :messages="$errors->get('phone_number')" class="mt-2" />
        </div>

        <!-- Location -->
        <div>
            <x-input-label for="location" :value="__('Location')" />
            <x-text-input id="location" name="location" value="{{ old('location', $user->location) }}" class="block mt-1 w-full" />
            <x-input-error :messages="$errors->get('location')" class="mt-2" />
        </div>

        <!-- Profile Picture -->
        <div>
            <x-input-label for="profile_picture" :value="__('Profile Picture')" />
            <x-text-input id="profile_picture" class="block mt-1 w-full"
                type="file"
                name="profile_picture" />
            <x-input-error :messages="$errors->get('profile_picture')" class="mt-2" />
            @if ($user->profile_picture)
                <div class="mt-2">
                    <img src="{{ asset('storage/' . $user->profile_picture) }}" alt="Profile Picture" class="rounded-full w-24 h-24 object-cover">
                </div>
            @endif
        </div>

        <!-- Skills -->
        <div>
            <x-input-label for="skills" :value="__('Skills')" />
            <div class="flex flex-wrap">
                @foreach ($skills as $skill)
                    <div class="w-1/2 md:w-1/3 xl:w-1/4 p-2">
                        <label class="flex items-center">
                            <input type="checkbox" name="skills[]" value="{{ $skill->name }}" 
                            @if($user->skills->contains($skill->id)) checked @endif />
                            <span class="ml-2">{{ $skill->name }}</span>
                        </label>
                    </div>
                @endforeach
            </div>
            @error('skills')
                <span class="text-xs text-red-600">{{ $message }}</span>
            @enderror
        </div>
        @endrole
        @role('employee')
        <!-- Skills -->
        <div>
            <x-input-label for="skills" :value="__('Skills')" />
            <div class="flex flex-wrap">
                @foreach ($skills as $skill)
                    <div class="w-1/2 md:w-1/3 xl:w-1/4 p-2">
                        <label class="flex items-center">
                            <input type="checkbox" name="skills[]" value="{{ $skill->name }}" 
                            @if($user->skills->contains($skill->id)) checked @endif />
                            <span class="ml-2">{{ $skill->name }}</span>
                        </label>
                    </div>
                @endforeach
            </div>
            @error('skills')
                <span class="text-xs text-red-600">{{ $message }}</span>
            @enderror
        </div>
        @endrole

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
