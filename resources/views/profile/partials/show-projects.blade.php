<section>
    <header class="flex justify-between">
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Alumni Projects') }}
        </h2>
    </header>

    <ul>
        @foreach($projects as $project)
            <li class="p-6 my-2 bg-gray-100">
                <h3 class="font-bold">{{ $project->title }}</h3>
                <p>{{ $project->description }}</p>
                <p class="mt-10">{{ 'Posted On: ' }}<b>{{ date('M d, Y', strtotime($project->posted_on)) }}</b></p>
            </li>
        @endforeach
    </ul>
</section>