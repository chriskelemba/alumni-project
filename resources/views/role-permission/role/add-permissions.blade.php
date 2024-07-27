<x-app-layout>
    <div class="container mx-auto p-5">
        <div class="flex flex-wrap justify-center">
            <div class="w-full p-6">
                @if (session('status'))
                    <div class="bg-green-500 text-white font-bold py-2 px-4 rounded mb-4">{{ session('status') }}</div>
                @endif
                
                <div class="bg-white shadow-md rounded p-4">
                    <div class="flex justify-between mb-4">
                        <h4 class="text-lg font-bold">Role: {{ $role->name }}</h4>
                        <a href="{{ url('roles') }}">
                            <x-danger-button>{{ __('Back') }}</x-danger-button>
                        </a>
                    </div>
                    <div class="p-4">
                        <form action="{{ url('roles/'.$role->id.'/give-permissions') }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="mb-4">
                                @error('permission')
                                    <span class="text-red-500">{{ $message }}</span>
                                @enderror

                                <x-input-label for="permissions" :value="__('Permissions')" />
                                <div id="permissions" class="flex flex-wrap">
                                    @foreach ($permissions as $permission)
                                    <div class="w-1/2 md:w-1/3 xl:w-1/4 p-2">
                                        <label class="flex items-center">
                                            <input type="checkbox"
                                            name="permission[]"
                                            value="{{ $permission->name }}"
                                            {{ in_array($permission->id, $rolePermissions) ? 'checked':'' }}
                                            />
                                            <span class="ml-2">{{ $permission->name }}</span>
                                        </label>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="mb-4 mt-6">
                                <x-primary-button>
                                    {{ __('Update Role') }}
                                </x-primary-button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
