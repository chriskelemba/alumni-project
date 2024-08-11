<x-app-layout>
    <div class="container mx-auto p-5">
        <div class="flex flex-wrap justify-center">
            <div class="w-full p-6">
                <div class="bg-white shadow-md rounded p-4">
                    <div class="flex justify-between mb-4">
                        <h4 class="text-lg font-bold">Apply for {{ $job->title }}</h4>
                        <a href="{{ url('jobs/'.$job->id.'/show') }}">
                            <x-danger-button>{{ __('Back') }}</x-danger-button>
                        </a>
                    </div>
                    <form method="POST" action="{{ url('jobs/'.$job->id) }}" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-4">
                            <x-input-label for="name" :value="__('Name')" />
                            <x-text-input id="name" name="name" class="block mt-1 w-full" value="{{ $user->name }}" required />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="email" :value="__('Email')" />
                            <x-text-input id="email" name="email" type="email" class="block mt-1 w-full" value="{{ $user->email }}" readonly />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="resume" :value="__('Resume (PDF or DOCX)')" />
                            <x-text-input id="resume" name="resume" type="file" class="block mt-1 w-full" required />
                            <x-input-error :messages="$errors->get('resume')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="cover_letter" :value="__('Cover Letter')" />
                            <textarea id="cover_letter" name="cover_letter" rows="10" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full" required></textarea>
                            <x-input-error :messages="$errors->get('cover_letter')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button>
                                {{ __('Apply') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
