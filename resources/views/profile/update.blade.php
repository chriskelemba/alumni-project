<x-app-layout>
    <div class="container mx-auto p-5">
        <div class="flex flex-wrap justify-center">
            <div class="w-full p-6">
                <div class="bg-white shadow-md rounded p-4">
                    <div class="flex justify-between mb-4">
                        <h4 class="text-lg font-bold">Edit Profile</h4>
                        <a href="{{ url('profile') }}">
                            <x-danger-button>{{ __('Back') }}</x-danger-button>
                        </a>
                    </div>
                    <div class="p-4">
                        <form action="{{ route('update-profile2') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                                <!-- Name -->
                                <div class="mb-4">
                                    <x-input-label for="name" :value="__('Name')" />
                                    <x-text-input id="name" name="name" value="{{ old('name', $user->name) }}" class="block mt-1 w-full" />
                                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                </div>

                                <!-- Email -->
                                <div class="mb-4">
                                    <x-input-label for="email" :value="__('Email')" />
                                    <x-text-input id="email" name="email" value="{{ old('email', $user->email) }}" class="block mt-1 w-full" />
                                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                </div>

                                <!-- Phone Number -->
                                <div class="mb-4">
                                    <x-input-label for="phone_number" :value="__('Phone Number')" />
                                    <x-text-input id="phone_number" name="phone_number" value="{{ old('phone_number', $user->phone_number) }}" class="block mt-1 w-full" />
                                    <x-input-error :messages="$errors->get('phone_number')" class="mt-2" />
                                </div>

                                <!-- Location -->
                                <div class="mb-4">
                                    <x-input-label for="location" :value="__('Location')" />
                                    <x-text-input id="location" name="location" value="{{ old('location', $user->location) }}" class="block mt-1 w-full" />
                                    <x-input-error :messages="$errors->get('location')" class="mt-2" />
                                </div>

                                <!-- Profile Picture -->
                                <div class="mb-4">
                                    <x-input-label for="profile_picture" :value="__('Profile Picture')" />
                                    <x-text-input id="profile_picture" type="file" name="profile_picture" class="block mt-1 w-full" />
                                    <x-input-error :messages="$errors->get('profile_picture')" class="mt-2" />
                                    @if ($user->profile_picture)
                                        <div class="mt-2">
                                            <img src="{{ asset('storage/' . $user->profile_picture) }}" alt="Profile Picture" class="rounded-full w-24 h-24 object-cover">
                                        </div>
                                    @endif
                                </div>

                            <div class="mt-4">
                                <x-primary-button>
                                    {{ __('Update Profile') }}
                                </x-primary-button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>