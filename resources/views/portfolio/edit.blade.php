<x-app-layout>
    @if (session('status'))
        <div class="bg-green-500 text-white font-bold rounded p-4 mb-4" role="alert">
            {{ session('status') }}
        </div>
    @endif

    <div class="container mx-auto p-5">
        <div class="flex flex-wrap justify-center">
            <div class="w-full p-6">
                <div class="bg-white shadow-md rounded p-4">
                    <div class="flex justify-between mb-4">
                        <h4 class="text-lg font-bold">Edit Portfolio</h4>
                        <a href="{{ url('profile/'.auth()->user()->id) }}">
                            <x-danger-button>{{ __('Back') }}</x-danger-button>
                        </a>
                    </div>
                    <div class="p-4">
                        <form action="{{ route('update-portfolio', $portfolio->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="mb-4">
                                <x-input-label for="description" :value="__('Description')" />
                                <textarea id="description" name="description" rows="8" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full" required>{{ old('description', $portfolio->description) }}</textarea>
                            </div>

                            <div class="mb-4">
                                <x-input-label for="skills" :value="__('Skills')" />
                                <textarea id="skills" name="skills" rows="8" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full">{{ old('skills', $portfolio->skills) }}</textarea>
                            </div>

                            <div class="mb-4">
                                <x-input-label for="achievements" :value="__('Achievements')" />
                                <textarea id="achievements" name="achievements" rows="8" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full">{{ old('achievements', $portfolio->achievements) }}</textarea>
                            </div>

                            <div class="mb-4">
                                <x-input-label for="work_experience" :value="__('Work Experience')" />
                                <textarea id="work_experience" name="work_experience" rows="8" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full">{{ old('work_experience', $portfolio->work_experience) }}</textarea>
                            </div>

                            <div class="mb-4">
                                <x-input-label for="education" :value="__('Education')" />
                                <textarea id="education" name="education" rows="8" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full">{{ old('education', $portfolio->education) }}</textarea>
                            </div>

                            <div class="flex items-center justify-end mt-6">
                                <x-primary-button>
                                    {{ __('Update Portfolio') }}
                                </x-primary-button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
