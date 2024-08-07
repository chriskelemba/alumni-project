<x-profile-layout>
    @if (session('error'))
        <div class="bg-red-500 text-white font-bold py-2 px-4 rounded mb-4">{{ session('error') }}</div>
    @endif
    <form method="POST" action="{{ route('save-profile') }}" enctype="multipart/form-data">
        @csrf

        @role('alumni')
        <h1 class="font-bold text-xl mb-5">Create your Profile</h1>
        @endrole
        @role('employee')
        <h1 class="font-bold text-xl mb-5">Select your Skills</h1>
        @endrole
        @role('alumni')
        <!-- Name -->
        <div class="mb-4">
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" value="{{ $user->name }}" readonly />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email -->
        <div class="mb-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" value="{{ $user->email }}" readonly />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Phone Number -->
        <div class="mb-4">
            <x-input-label for="phone_number" :value="__('Phone Number')" />
            <x-text-input id="phone_number" class="block mt-1 w-full" type="text" name="phone_number" value="{{ $user->phone_number }}" />
            <x-input-error :messages="$errors->get('phone_number')" class="mt-2" />
        </div>

        <!-- Location -->
        <div class="mb-4">
            <x-input-label for="location" :value="__('Location')" />
            <x-text-input id="location" class="block mt-1 w-full" type="text" name="location" value="{{ $user->location }}" />
            <x-input-error :messages="$errors->get('location')" class="mt-2" />
        </div>

        <!-- Profile Picture -->
        <div class="mb-4">
            <x-input-label for="profile_picture" :value="__('Profile Picture')" />
            <x-text-input id="profile_picture" class="block mt-1 w-full" type="file" name="profile_picture" />
            <x-input-error :messages="$errors->get('profile_picture')" class="mt-2" />
        </div>
        @endrole

        <!-- Skills -->
        <div class="mb-4">
            <x-input-label for="skills" :value="__('Skills')" />
            <div class="flex flex-wrap">
                @foreach ($skills as $skill)
                    <div class="w-1/2 md:w-1/3 xl:w-1/4 p-2">
                        <label class="flex items-center">
                            <input type="checkbox" name="skills[]" value="{{ $skill->id }}" class="form-checkbox">
                            <span class="ml-2">{{ $skill->name }}</span>
                        </label>
                    </div>
                @endforeach
            </div>
            <x-input-error :messages="$errors->get('skills')" class="mt-2" />
        </div>

        @role('alumni')
        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                {{ __('Save Profile') }}
            </x-primary-button>
        </div>
        @endrole
        @role('employee')
        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                {{ __('Save Skills') }}
            </x-primary-button>
        </div>
        @endrole
    </form>

    <form method="POST" action="{{ route('logout') }}" class="flex items-center justify-end mt-4">
        @csrf
        <x-primary-button>
            {{ __('Logout') }}
        </x-primary-button>
    </form>
</x-profile-layout>
