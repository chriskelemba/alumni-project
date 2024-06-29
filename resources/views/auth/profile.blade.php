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
        
            <select id="skills" class="block mt-1 w-full" name="skills[]" multiple>
                <option value="HTML">HTML</option>
                <option value="CSS">CSS</option>
                <option value="JavaScript">JavaScript</option>
                <option value="PHP">PHP</option>
                <option value="Laravel">Laravel</option>
            </select>
        
            <x-input-error :messages="$errors->get('skills')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button class="ms-3">
                {{ __('Save Profile') }}
            </x-primary-button>
        </div>
    </form>
    {{-- <div class="container mx-auto p-5">
        <div class="flex flex-wrap justify-center">
            <div class="w-full p-6">
                <div class="flex justify-between mb-4">
                    <h4 class="text-lg font-bold">Activate Your Account</h4>
                </div>
                <div class="p-4">
                    @if (session('error'))
                        <p class="text-red-500">{{ session('error') }}</p>
                    @endif
                    <form method="POST" action="{{ route('save-profile', $token) }}">
                        @csrf
                        <div>
                            <label for="name">Name:</label>
                            <input type="text" id="name" name="name" value="{{ old('name') }}">
                        </div>
                    
                        <div>
                            <label for="email">Email:</label>
                            <input type="email" id="email" name="email" value="{{ old('email') }}" readonly>
                        </div>
                    
                        <div>
                            <label for="skills">Skills:</label>
                            <input type="text" id="skills" name="skills">
                        </div>
                    
                        <button type="submit">Save profile</button>
                    </form>
                </div>
            </div>
        </div>
    </div> --}}
</x-guest-layout>