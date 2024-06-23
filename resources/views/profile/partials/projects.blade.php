<section>
    <header class="flex justify-between">
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('My Projects') }}
        </h2>

        <form action="{{ url('/projects/create') }}">
            <x-primary-button>{{ __('New Project') }}</x-primary-button>
        </form>
    </header>

    <ul>
        @foreach($projects as $project)
            <li>
                <h3>{{ $project->title }}</h3>
                <p>{{ $project->description }}</p>
            </li>
        @endforeach
    </ul>
</section>