<x-profile-layout>
    @if (session('status'))
        <div class="bg-green-500 text-white font-bold rounded p-4 mb-4" role="alert">{{ session('status') }}</div>
    @endif

    @if ($errors->any())
    <div class="bg-red-500 text-white font-bold rounded p-4 mb-4">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('save-project') }}" method="POST">
        @csrf

        <h1 class="font-bold text-xl mb-5">Post your Project</h1>

        <div class="mb-4">
            <x-input-label for="title" :value="__('Title')" />
            <x-text-input id="title" class="block mt-1 w-full" type="text" name="title" />
        </div>

        <div class="mb-4">
            <x-input-label for="description" :value="__('Description')" />
            <textarea id="description" name="description" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full"></textarea>
        </div>

        <div class="mb-4">
            <x-input-label for="video_url" :value="__('Video URL')" />
            <x-text-input id="video_url" class="block mt-1 w-full" type="url" name="video_url" />
        </div>

        <div class="mb-4">
            <x-input-label for="github_repo_url" :value="__('GitHub Repo URL')" />
            <x-text-input id="github_repo_url" class="block mt-1 w-full" type="url" name="github_repo_url" />
        </div>

        <div class="mb-4">
            <x-input-label for="tools_used" :value="__('Tools Used')" />
            <x-text-input id="tools_used" class="block mt-1 w-full" type="text" name="tools_used" />
        </div>

        <div class="mb-4">
            <x-input-label for="programming_language_used" :value="__('Programming Language Used')" />
            <x-text-input id="programming_language_used" class="block mt-1 w-full" type="text" name="programming_language_used" />
        </div>

        <div class="mb-4">
            <x-input-label for="is_private" :value="__('Project Type')" />
            <div class="flex items-center">
                <input type="radio" id="public_project" name="is_private" value="0" class="mr-2" checked>
                <x-input-label for="public_project" :value="__('Public')" />
                <input type="radio" id="private_project" name="is_private" value="1" class="mr-2 ml-4">
                <x-input-label for="private_project" :value="__('Private')" />
            </div>
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                {{ __('Post Project') }}
            </x-primary-button>
        </div>
    </form>

    </form>
    <a href="{{ url('confirm-project') }}" class="flex items-center justify-end mt-4">
        <x-danger-button>{{ __('Back') }}</x-danger-button>
    </a>
</x-profile-layout>
