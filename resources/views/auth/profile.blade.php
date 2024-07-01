<x-guest-layout>
    @if (session('error'))
        <p class="text-red-500">{{ session('error') }}</p>
    @endif
    <form method="POST" action="{{ route('save-profile', $token) }}">
        @csrf
        
        <!-- Name -->
        <div class="mt-4">
            <x-input-label for="name" :value="__('Name')" />

            <x-text-input id="name" class="block mt-1 w-full"
                            type="text"
                            name="name"
                            value="{{ $user->name }}"
                            readonly/>

            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>
        
        <!-- Email -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />

            <x-text-input id="email" class="block mt-1 w-full"
                            type="email"
                            name="email"
                            value="{{ $user->email }}"
                            readonly/>

            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Skills -->
        <div class="mt-4">
            <x-input-label for="skills" :value="__('Skills')" />
            
            <div class="flex flex-wrap">
                @foreach ($skills as $skill)
                    <div class="w-1/2 md:w-1/3 xl:w-1/4 p-2">
                        <label>
                            <input type="checkbox" name="skills[]" value="{{ $skill->id }}">
                            {{ $skill->name }}
                        </label>
                    </div>
                @endforeach
            </div>
            
            <x-input-error :messages="$errors->get('skills')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button class="ms-3">
                {{ __('Save Profile') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>