<x-app-layout>
    <div class="container mx-auto p-6">
        <div class="bg-white shadow-lg rounded-lg overflow-hidden">
            <!-- Header Section -->
            <div class="flex justify-between items-center px-6 py-4 border-b border-gray-200">
                {{-- <a href="{{ url('projects') }}" class="text-blue-500 hover:underline">
                    <x-danger-button>Back</x-danger-button>
                </a> --}}
                <h1 class="text-3xl font-semibold text-gray-800">{{ $project->title }}</h1>
                <div></div>
            </div>

            <!-- Content Section -->
            <div class="p-6">
                <!-- Project Description -->
                <section class="mb-8">
                    <h2 class="text-2xl font-semibold text-gray-800 mb-2">Project Description</h2>
                    <p class="text-gray-600">{{ $project->description }}</p>
                </section>

                <!-- Posted By -->
                <section class="mb-8">
                    <h2 class="text-2xl font-semibold text-gray-800 mb-2">Posted By</h2>
                    <div class="flex items-center space-x-4">
                        <!-- Profile Picture -->
                        @if ($user->profile_picture)
                            <img src="{{ Storage::url($user->profile_picture) }}" alt="Profile Picture" class="rounded-full h-16 w-16 object-cover border-2 border-gray-200">
                        @else
                            <img src="{{ asset('images/default-profile.png') }}" alt="Default Profile Picture" class="rounded-full h-16 w-16 object-cover border-2 border-gray-200">
                        @endif              
                        <!-- User Name -->
                        <a href="{{ url('profile/'.$user->id) }}" class="text-blue-500 hover:underline text-xl font-medium">
                            {{ $user->name }}
                        </a>
                    </div>
                </section>
                

                <!-- Posted On -->
                <section class="mb-8">
                    <h2 class="text-2xl font-semibold text-gray-800 mb-2">Posted On</h2>
                    <p class="text-gray-600">
                        {{ 'Posted On: ' }}<b class="bg-white p-2 rounded-3xl">{{ date('M d, Y', strtotime($project->posted_on)) }}</b>
                    </p>
                </section>

                <!-- Project Links -->
                @foreach(['url' => 'Project URL', 'video_url' => 'Video URL', 'github_repo_url' => 'GitHub Repository'] as $field => $label)
                    @if($project->$field)
                        <section class="mb-8">
                            <h2 class="text-2xl font-semibold text-gray-800 mb-2">{{ $label }}</h2>
                            <p class="text-gray-600">
                                <a href="{{ $project->$field }}" target="_blank" class="text-blue-500 hover:underline">
                                    {{ $project->$field }}
                                </a>
                            </p>
                        </section>
                    @endif
                @endforeach

                <!-- Additional Information -->
                @foreach(['tools_used' => 'Tools Used', 'programming_language_used' => 'Programming Language Used'] as $field => $label)
                    @if($project->$field)
                        <section class="mb-8">
                            <h2 class="text-2xl font-semibold text-gray-800 mb-2">{{ $label }}</h2>
                            <p class="text-gray-600">{{ $project->$field }}</p>
                        </section>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
