<x-app-layout>
    <div class="container mx-auto p-5">
        <div class="flex flex-wrap justify-center">
            <div class="w-full p-6">
                <div class="bg-white shadow-md rounded p-4">
                    <div class="flex justify-between mb-4">
                        <h4 class="text-lg font-bold">Edit Job</h4>
                        <a href="{{ url('jobs') }}">
                            <x-danger-button>{{ __('Back') }}</x-danger-button>
                        </a>
                    </div>
                    <div class="p-4">
                        <form action="{{ url('jobs/'.$job->id) }}" method="POST" enctype="multipart/form-data" >
                            @csrf
                            @method('PUT')

                            <div class="mb-4">
                                <x-input-label for="title" :value="__('Title')" />
                                <x-text-input id="title" name="title" value="{{ $job->title }}" class="block mt-1 w-full" />
                                <x-input-error :messages="$errors->get('title')" class="mt-2" />
                            </div>
                            
                            <div class="mb-4">
                                <x-input-label for="company" :value="__('Company')" />
                                <x-text-input id="company" name="company" value="{{ $job->company }}" class="block mt-1 w-full" />
                                <x-input-error :messages="$errors->get('company')" class="mt-2" />
                            </div>

                            <div class="mb-4">
                                <x-input-label for="location" :value="__('Location')" />
                                <x-text-input id="location" name="location" value="{{ $job->location }}" class="block mt-1 w-full" />
                                <x-input-error :messages="$errors->get('location')" class="mt-2" />
                            </div>

                            <div class="mb-4">
                                <x-input-label for="description" :value="__('Description')" />
                                <x-text-input id="description" name="description" value="{{ $job->description }}" class="block mt-1 w-full" />
                                <x-input-error :messages="$errors->get('description')" class="mt-2" />
                            </div>
                            
                            <div class="mb-4">
                                <x-input-label for="responsibilities" :value="__('Responsibilities')" />
                                <x-text-input id="responsibilities" name="responsibilities" value="{{ $job->responsibilities }}" class="block mt-1 w-full" />
                                <x-input-error :messages="$errors->get('responsibilities')" class="mt-2" />
                            </div>
                            
                            <div class="mb-4">
                                <x-input-label for="qualifications" :value="__('Qualifications')" />
                                <x-text-input id="qualifications" name="qualifications" value="{{ $job->qualifications }}" class="block mt-1 w-full" />
                                <x-input-error :messages="$errors->get('qualifications')" class="mt-2" />
                            </div>
                            
                            <div class="mb-4">
                                <x-input-label for="aboutus" :value="__('About Us')" />
                                <x-text-input id="aboutus" name="aboutus" value="{{ $job->aboutus }}" class="block mt-1 w-full" />
                                <x-input-error :messages="$errors->get('aboutus')" class="mt-2" />
                            </div>

                            <div class="mt-4">
                                <x-input-label for="logo" :value="__('Logo')" />
                                <x-text-input id="logo" class="block mt-1 w-full"
                                    type="file"
                                    name="logo" />
                                <x-input-error :messages="$errors->get('logo')" class="mt-2" />
                            </div>
                            
                            <div class="mb-4">
                                <x-input-label for="skills" :value="__('Skills')" />
                                <div class="flex flex-wrap">
                                    @foreach ($skills as $skill)
                                    <div class="w-1/2 md:w-1/3 xl:w-1/4 p-2">
                                        <label>
                                            <input type="checkbox" name="skills[]" value="{{ $skill->name }}"  
                                                @if($job->skills->contains($skill->id)) checked @endif />
                                            {{ $skill->name }}
                                        </label>
                                    </div>
                                    @endforeach
                                </div>
                                <x-input-error :messages="$errors->get('skills')" class="mt-2" />
                            </div>
                            
                            <div class="mt-4">
                                <x-primary-button>
                                    {{ __('Update Job') }}
                                </x-primary-button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
