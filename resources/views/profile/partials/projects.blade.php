<section>
    <header class="flex justify-between mb-10">
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('My Projects') }}
        </h2>
    
        @if(auth()->user()->id === $user->id)
            <a href="{{ url('/projects/create') }}">
                <x-primary-button>{{ __('New Project') }}</x-primary-button>
            </a>
        @endif
    </header>

    <ul>
        @foreach($projects as $project)
            @if(auth()->check() && (auth()->user()->id === $project->user_id || !$project->is_private))
                <li class="p-6 my-2 bg-gray-100">
                    <div class="mb-4">
                        <div class="flex items-center">
                            <h3 class="font-bold mr-4">{{ $project->title }}</h3>
                            <div class="flex items-center">
                                @if($project->is_private)
                                    <!-- Private Icon/Badge -->
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-lock-fill text-red-500 mr-1" viewBox="0 0 16 16">
                                        <path d="M8 1a2 2 0 0 1 2 2v2h2a2 2 0 0 1 2 2v9a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h2V3a2 2 0 0 1 2-2zm-4 4v9h8V5H4z"/>
                                    </svg>
                                    <span class="text-red-500 font-semibold">Private</span>
                                @else
                                    <!-- Public Icon/Badge -->
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-globe text-green-500 mr-1" viewBox="0 0 16 16">
                                        <path d="M8 0a8 8 0 1 0 8 8A8 8 0 0 0 8 0zM8 1.5a6.5 6.5 0 0 1 6.5 6.5A6.5 6.5 0 0 1 8 14.5 6.5 6.5 0 0 1 1.5 8 6.5 6.5 0 0 1 8 1.5zm0 4a2.5 2.5 0 0 0-2.5 2.5A2.5 2.5 0 0 0 8 10.5 2.5 2.5 0 0 0 10.5 8 2.5 2.5 0 0 0 8 5.5z"/>
                                    </svg>
                                    <span class="text-green-500 font-semibold">Public</span>
                                @endif
                            </div>
                        </div>
    
                        <p>{{ \Illuminate\Support\Str::limit($project->description, 150, '...') }}</p>
    
                        <p class="mt-10">
                            {{ 'Posted On: ' }}<b class="bg-white p-2 rounded-3xl">{{ date('M d, Y', strtotime($project->posted_on)) }}</b>
                        </p>
                    </div>                
    
                    <div class="flex">
                        @if(auth()->check() && auth()->user()->id === $project->user_id)
                            @if(!$project->is_published)
                                <form action="{{ route('projects.publish', $project->id) }}" class="mr-2" method="POST">
                                    @csrf
                                    <x-primary-button>
                                        {{ __('Publish') }}
                                    </x-primary-button>
                                </form>
                            @else
                                <form action="{{ route('projects.unpublish', $project->id) }}" class="mr-2" method="POST">
                                    @csrf
                                    <x-primary-button>
                                        {{ __('UnPublish') }}
                                    </x-primary-button>
                                </form>
                            @endif
    
                            <a href="{{ url('projects/'.$project->id.'/edit') }}" class="mr-2">
                                <x-primary-button>{{ __('Edit') }}</x-primary-button>
                            </a>
    
                            <a href="{{ url('projects/'.$project->id.'/delete') }}" onclick="return confirm('Are you sure you want to delete this project?')">
                                <x-danger-button>{{ __('Delete') }}</x-danger-button>
                            </a>
                        @endif
                    </div>
                </li>
            @endif
        @endforeach
    </ul>
    
</section>
