<x-app-layout>
    <div class="container mx-auto p-5">
        <div class="flex flex-wrap justify-center">
            <div class="w-full p-6">
                <div class="bg-white shadow-md rounded p-4">
                    <div class="flex justify-between mb-4">
                        <h4 class="text-lg font-bold">Edit Project</h4>
                        <a href="{{ url('profile/'.auth()->user()->id) }}">
                            <x-danger-button>{{ __('Back') }}</x-danger-button>
                        </a>
                    </div>
                    <div class="p-4">
                        <form action="{{ url('projects/'.$project->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="mb-4">
                                <x-input-label for="title" :value="__('Title')" />
                                <x-text-input id="title" class="block mt-1 w-full" type="text" name="title" value="{{ old('title', $project->title) }}" required />
                            </div>

                            <div class="mb-4">
                                <x-input-label for="description" :value="__('Description')" />
                                <textarea id="description" name="description" class="block mt-1 w-full p-2 text-sm text-gray-700 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>{{ old('description', $project->description) }}</textarea>
                            </div>

                            <div class="mb-4">
                                <x-input-label for="video_url" :value="__('Video URL')" />
                                <x-text-input id="video_url" class="block mt-1 w-full" type="url" name="video_url" value="{{ old('video_url', $project->video_url) }}" />
                            </div>

                            <div class="mb-4">
                                <x-input-label for="github_repo_url" :value="__('GitHub Repo URL')" />
                                <x-text-input id="github_repo_url" class="block mt-1 w-full" type="url" name="github_repo_url" value="{{ old('github_repo_url', $project->github_repo_url) }}" />
                            </div>

                            <div class="mb-4">
                                <x-input-label for="tools_used" :value="__('Tools Used')" />
                                <x-text-input id="tools_used" class="block mt-1 w-full" type="text" name="tools_used" value="{{ old('tools_used', $project->tools_used) }}" />
                            </div>

                            <div class="mb-4">
                                <x-input-label for="programming_language_used" :value="__('Programming Language Used')" />
                                <x-text-input id="programming_language_used" class="block mt-1 w-full" type="text" name="programming_language_used" value="{{ old('programming_language_used', $project->programming_language_used) }}" />
                            </div>

                            <div class="mb-4">
                                <x-input-label for="is_private" :value="__('Project Type')" />
                                <div class="flex items-center mt-1">
                                    <input type="radio" id="public_project" name="is_private" value="0" class="mr-2" {{ old('is_private', $project->is_private) == 0 ? 'checked' : '' }}>
                                    <x-input-label for="public_project" :value="__('Public')" class="mr-4" />
                                    <input type="radio" id="private_project" name="is_private" value="1" class="mr-2" {{ old('is_private', $project->is_private) == 1 ? 'checked' : '' }}>
                                    <x-input-label for="private_project" :value="__('Private')" />
                                </div>
                            </div>

                            <div class="mb-4 mt-6">
                                <x-primary-button>
                                    {{ __('Update') }}
                                </x-primary-button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
