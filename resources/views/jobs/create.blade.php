<x-app-layout>
    <div class="container mx-auto p-5">
        <div class="flex flex-wrap justify-center">
            <div class="w-full p-6">
                <div class="bg-white shadow-md rounded p-4">
                    <div class="flex justify-between mb-4">
                        <h4 class="text-lg font-bold">Create Job</h4>
                        <a href="{{ url('jobs') }}">
                            <x-danger-button>{{ __('Back') }}</x-danger-button>
                        </a>
                    </div>
                    <div class="p-4">
                        <form action="{{ url('jobs') }}" method="POST">
                            @csrf
                            
                            <div class="mb-4">
                                <x-input-label for="title" :value="__('Title')" />
                                <x-text-input id="title" name="title" class="block mt-1 w-full" />
                                <x-input-error :messages="$errors->get('title')" class="mt-2" />
                            </div>
                            
                            <div class="mb-4">
                                <x-input-label for="company" :value="__('Company')" />
                                <x-text-input id="company" name="company" class="block mt-1 w-full" />
                                <x-input-error :messages="$errors->get('company')" class="mt-2" />
                            </div>
                            
                            <div class="mb-4">
                                <x-input-label for="location" :value="__('Location')" />
                                <x-text-input id="location" name="location" class="block mt-1 w-full" />
                                <x-input-error :messages="$errors->get('location')" class="mt-2" />
                            </div>

                            <div class="mb-4">
                                <x-input-label for="description" :value="__('Description')" />
                                <textarea id="description" name="description" class="block font-medium text-sm text-gray-700 mt-1 rounded w-full"></textarea>
                                <x-input-error :messages="$errors->get('description')" class="mt-2" />
                            </div>
                            
                            <div class="mb-4">
                                <x-input-label for="responsibilities" :value="__('Responsibilities')" />
                                <textarea id="responsibilities" name="responsibilities" class="block font-medium text-sm text-gray-700 mt-1 rounded w-full"></textarea>
                                <x-input-error :messages="$errors->get('responsibilities')" class="mt-2" />
                            </div>
                            
                            <div class="mb-4">
                                <x-input-label for="qualifications" :value="__('Qualifications')" />
                                <textarea id="qualifications" name="qualifications" class="block font-medium text-sm text-gray-700 mt-1 rounded w-full"></textarea>
                                <x-input-error :messages="$errors->get('qualifications')" class="mt-2" />
                            </div>

                            <div class="mb-4">
                                <x-input-label for="aboutus" :value="__('About Us')" />
                                <textarea id="aboutus" name="aboutus" class="block font-medium text-sm text-gray-700 mt-1 rounded w-full"></textarea>
                                <x-input-error :messages="$errors->get('aboutus')" class="mt-2" />
                            </div>
                            
                            <div class="mb-4">
                                <x-input-label for="skills" :value="__('Skills')" />
                                <div class="flex flex-wrap">
                                    @foreach ($skills as $skill)
                                    <div class="w-1/2 md:w-1/3 xl:w-1/4 p-2">
                                        <label>
                                            <input type="checkbox" name="skills[]" value="{{ $skill->name }}" />
                                            {{ $skill->name }}
                                        </label>
                                    </div>
                                    @endforeach
                                </div>
                                <x-input-error :messages="$errors->get('skills')" class="mt-2" />
                            </div>

                            <div class="mb-4">
                                <x-primary-button>
                                    {{ __('Post Job') }}
                                </x-primary-button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
