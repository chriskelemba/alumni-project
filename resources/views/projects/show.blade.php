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
                    
                    <!-- Project Description -->
                    <h1 class="text-gray-600 text-center text-2xl font-bold p-5 mt-10">Project Description</h1>
                    <p class="text-gray-600">{{ $project->description }}</p>
                    
                    <!-- Posted By -->
                    <h1 class="text-gray-600 text-center text-2xl font-bold p-5 mt-10">Posted By</h1>
                    <a href="{{ url('profile/'.$project->user->id) }}">
                        {{ $project->user->name }}
                    </a>
                    
                    <!-- Posted On -->
                    <h1 class="text-gray-600 text-center text-2xl font-bold p-5 mt-10">Posted On</h1>
                    <p class="text-gray-600">{{ $project->posted_on }}</p>

                    <!-- URL -->
                    @if($project->url)
                        <h1 class="text-gray-600 text-center text-2xl font-bold p-5 mt-10">Project URL</h1>
                        <p class="text-gray-600"><a href="{{ $project->url }}" target="_blank" class="text-blue-500">{{ $project->url }}</a></p>
                    @endif

                    <!-- Video URL -->
                    @if($project->video_url)
                        <h1 class="text-gray-600 text-center text-2xl font-bold p-5 mt-10">Video URL</h1>
                        <p class="text-gray-600"><a href="{{ $project->video_url }}" target="_blank" class="text-blue-500">{{ $project->video_url }}</a></p>
                    @endif

                    <!-- GitHub Repo URL -->
                    @if($project->github_repo_url)
                        <h1 class="text-gray-600 text-center text-2xl font-bold p-5 mt-10">GitHub Repository</h1>
                        <p class="text-gray-600"><a href="{{ $project->github_repo_url }}" target="_blank" class="text-blue-500">{{ $project->github_repo_url }}</a></p>
                    @endif

                    <!-- Tools Used -->
                    @if($project->tools_used)
                        <h1 class="text-gray-600 text-center text-2xl font-bold p-5 mt-10">Tools Used</h1>
                        <p class="text-gray-600">{{ $project->tools_used }}</p>
                    @endif

                    <!-- Programming Language Used -->
                    @if($project->programming_language_used)
                        <h1 class="text-gray-600 text-center text-2xl font-bold p-5 mt-10">Programming Language Used</h1>
                        <p class="text-gray-600">{{ $project->programming_language_used }}</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
