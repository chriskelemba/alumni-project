<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Portfolio of ') . $user->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex justify-between">
                        <h3 class="text-2xl font-bold">{{ $portfolio->title }}</h3>
                        <a href="{{ url('profile/'.$user->id) }}">
                            <x-danger-button>{{ __('Back') }}</x-danger-button>
                        </a>
                    </div>
                    <h4 class="text-xl font-semibold mt-5">About</h4>
                    <p class="text-gray-600">{{ $portfolio->description }}</p>

                    <div class="mt-4">
                        <h4 class="text-xl font-semibold">Skills</h4>
                        <p class="text-gray-600">{{ $portfolio->skills }}</p>
                    </div>

                    <div class="mt-4">
                        <h4 class="text-xl font-semibold">Achievements</h4>
                        <p class="text-gray-600">{{ $portfolio->achievements }}</p>
                    </div>

                    <div class="mt-4">
                        <h4 class="text-xl font-semibold">Work Experience</h4>
                        <p class="text-gray-600">{{ $portfolio->work_experience }}</p>
                    </div>

                    <div class="mt-4">
                        <h4 class="text-xl font-semibold">Education</h4>
                        <p class="text-gray-600">{{ $portfolio->education }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
