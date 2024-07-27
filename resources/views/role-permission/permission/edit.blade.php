<x-app-layout>
    <div class="container mx-auto p-5">
        <div class="flex flex-wrap justify-center">
            <div class="w-full p-6">
                <div class="bg-white shadow-md rounded p-4">
                    <div class="flex justify-between mb-4">
                        <h4 class="text-lg font-bold">Edit Permissions</h4>
                        <a href="{{ url('permissions') }}">
                            <x-danger-button>{{ __('Back') }}</x-danger-button>
                        </a>
                    </div>
                    <div class="p-4">
                        <form action="{{ url('permissions/'.$permission->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="mb-4">
                                <x-input-label for="name" :value="__('Permission Name')" />
                                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" value="{{ $permission->name }}" />
                            </div>
                            <div class="mb-4 mt-6">
                                <x-primary-button>
                                    {{ __('Update Permission') }}
                                </x-primary-button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
