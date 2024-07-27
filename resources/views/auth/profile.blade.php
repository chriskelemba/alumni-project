<x-app-layout>
    <div class="container mx-auto p-5">
        <div class="flex flex-wrap justify-center">
            <div class="w-full p-6">
                <div class="bg-white shadow-md rounded p-4">
                    <div class="flex justify-between mb-4">
                        <h4 class="text-lg font-bold">Create Your Profile</h4>
                    </div>
                    @if (session('error'))
                        <div class="bg-red-500 text-white font-bold py-2 px-4 rounded mb-4">{{ session('error') }}</div>
                    @endif
                    <form method="POST" action="{{ route('save-profile') }}" enctype="multipart/form-data">
                        @csrf

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

                        <!-- Profile Picture -->
                        <div class="mb-4">
                            <x-input-label for="profile_picture" :value="__('Profile Picture')" />
                            <x-text-input id="profile_picture" class="block mt-1 w-full" type="file" name="profile_picture" />
                            <x-input-error :messages="$errors->get('profile_picture')" class="mt-2" />
                        </div>

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

                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button>
                                {{ __('Save Profile') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
