<x-profile-layout>
                        <form action="{{ route('save-project') }}" method="POST">
                            @csrf

                            <div class="mb-4">
                                <x-input-label for="title" :value="__('Title')" />
                                <x-text-input id="title" class="block mt-1 w-full" type="text" name="title" />
                            </div>

                            <div class="mb-4">
                                <x-input-label for="description" :value="__('Description')" />
                                <textarea id="description" name="description" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full"></textarea>
                            </div>

                            <div class="mb-4">
                                <x-input-label for="is_private" :value="__('Project Type')" />
                                <div class="flex items-center">
                                    <input type="radio" id="public_project" name="is_private" value="0" class="mr-2" checked>
                                    <x-input-label for="public_project" :value="__('Public')" />
                                    <input type="radio" id="private_project" name="is_private" value="1" class="mr-2 ml-4">
                                    <x-input-label for="private_project" :value="__('Private')" />
                                </div>
                            </div>

                            <div class="flex items-center justify-end mt-4">
                                <x-primary-button>
                                    {{ __('Post Project') }}
                                </x-primary-button>
                            </div>
                        </form>
                        <form method="POST" action="{{ route('logout') }}" class="flex items-center justify-end mt-4">
                            @csrf
                            <x-primary-button>
                                {{ __('Logout') }}
                            </x-primary-button>
                        </form>
</x-profile-layout>
