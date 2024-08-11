<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ ('Projects') }}
        </h2>
    </x-slot>

    <div class="container mx-auto p-5">
        <div class="flex flex-wrap justify-center">
            <div class="w-full p-6">

                @if (session('status'))
                    <div class="bg-green-500 text-white font-bold rounded p-4 mb-4" role="alert">{{ session('status') }}</div>
                @endif

                <div class="bg-white shadow-md rounded p-4">
                    <div class="flex justify-between mb-4">
                        <h4 class="text-lg font-bold">Published Projects</h4>
                        <div>
                            @can('delete project')
                            <a href="{{ url('projects/trash') }}">
                                <x-primary-button>Recycling Bin</x-primary-button>
                            </a>
                            @endcan
                        </div>
                    </div>
                    <div class="p-6 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach ($projects as $project)
                        <div class="bg-gray-100 border border-gray-200 rounded-lg p-4 flex flex-col shadow-md hover:shadow-lg transition-shadow duration-300 ease-in-out">
                            <h5 class="text-xl font-semibold text-gray-800 mb-2">{{ $project->title }}</h5>
                            <p class="text-gray-600 mb-4">{{ Str::limit($project->description, 150) }}</p>
                            <div class="flex flex-col flex-grow">
                                <div class="flex items-center space-x-2 mb-4">
                                    <!-- Profile Picture -->
                                    @if ($project->user->profile_picture)
                                        <img src="{{ Storage::url($project->user->profile_picture) }}" alt="Profile Picture" class="rounded-full h-12 w-12 object-cover border-2 border-gray-200">
                                    @else
                                        <img src="{{ asset('images/default-profile.png') }}" alt="Default Profile Picture" class="rounded-full h-12 w-12 object-cover border-2 border-gray-200">
                                    @endif              
                                    <!-- User Name -->
                                    <a href="{{ url('profile/'.$project->user->id) }}" class="text-blue-500 hover:underline text-xl font-medium">
                                        {{ $project->user->name }}
                                    </a>
                                </div>
                                <p class="text-gray-600">
                                    {{ 'Posted On: ' }}<b class="bg-white p-2 rounded-3xl">{{ date('M d, Y', strtotime($project->posted_on)) }}</b>
                                </p>
                            </div>
                            <div class="mt-6 text-center">
                                <a href="{{ url('projects/'.$project->id.'/show') }}">
                                    <x-primary-button>View More</x-primary-button>
                                </a>
                            </div>
                        </div>
                    @endforeach
                    
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>