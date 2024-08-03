<x-app-layout>
    <div class="container mx-auto p-5">
        <div class="flex flex-wrap justify-center">
            <div class="w-full p-6">
                <div class="bg-white shadow-md rounded py-16 px-40">
                    <div class="mb-8 flex justify-center">
                        <x-danger-button class="bg-white hover:bg-white text-white py-2 px-4" disabled>Back</x-danger-button>
                        <h1 class="text-gray-800 text-4xl flex-1 text-center font-bold">{{ $project->title }}</h1>
                        <a href="{{ url('projects') }}">
                            <x-danger-button>{{ __('Back') }}</x-danger-button>
                        </a>
                    </div>
                    <h1 class="text-gray-600 text-center text-2xl font-bold p-5 mt-10">Project Description</h1>
                    <p class="text-gray-600">{{ $project->description }}</p>
                    <h1 class="text-gray-600 text-center text-2xl font-bold p-5 mt-10">Posted By</h1>
                    <p class="text-gray-600">{{ $project->posted_by }}</p>
                    <a href="{{ url('profile/'.$project->user->id) }}">
                        {{ $project->user->name }}
                    </a>
                    <h1 class="text-gray-600 text-center text-2xl font-bold p-5 mt-10">Posted On</h1>
                    <p class="text-gray-600">{{ $project->posted_on }}</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
