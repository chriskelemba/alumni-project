<section>
    <header class="flex justify-between">
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('My Projects') }}
        </h2>

        <a href="{{ url('/projects/create') }}">
            <x-primary-button>{{ __('New Project') }}</x-primary-button>
        </a>
    </header>

    <ul>
        @foreach($projects as $project)
            <li class="p-6 my-2 bg-gray-100">
                <h3 class="font-bold">{{ $project->title }}</h3>
                <p>{{ $project->description }}</p>
                <p class="mt-10">{{ 'Posted On: ' }}<b>{{ date('M d, Y', strtotime($project->posted_on)) }}</b></p>

                @if(auth()->user()->id === $project->user_id && !$project->is_published)
                    <form action="{{ route('projects.publish', $project->id) }}" method="POST">
                        @csrf
                        <x-primary-button>
                            {{ __('Publish') }}
                        </x-primary-button>
                    </form>
                @endif
            </li>
        @endforeach
    </ul>
</section>
