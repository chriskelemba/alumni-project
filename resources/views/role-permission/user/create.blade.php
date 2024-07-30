<x-app-layout>
    <div class="container mx-auto p-5">
        <div class="flex flex-wrap justify-center">
            <div class="w-full p-6">
                <div class="bg-white shadow-md rounded p-4">
                    <div class="flex justify-between mb-4">
                        <h4 class="text-lg font-bold">Create User</h4>
                        <a href="{{ url('users') }}">
                            <x-danger-button>{{ __('Back')}}</x-danger-button>
                        </a>
                    </div>
                    <div class="p-4">
                        <form action="{{ url('users') }}" method="POST">
                            @csrf
                            
                            <div class="mb-4">
                                <x-input-label for="name" :value="__('Name')" />
                                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" />
                            </div>
                            <div class="mb-4">
                                <x-input-label for="email" :value="__('Email')" />
                                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" />
                            </div>
                            <div class="mb-4">
                                <x-input-label for="password" :value="__('Password')" />
                                <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" />
                            </div>
                            <div class="mb-4">
                                <x-input-label for="roles" :value="__('Roles')" />
                                <select id="roles" name="roles[]" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full">
                                    <option value="">Select Role</option>

                                    @foreach ($roles as $role)
                                        <option value="{{ $role }}">{{ $role }}</option>
                                    @endforeach

                                </select>
                            </div>
                            <div class="mb-4 mt-6">
                                <x-primary-button>
                                    {{ __('Add User') }}
                                </x-primary-button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>