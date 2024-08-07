<x-app-layout>
    <div class="container mx-auto p-5">
        <div class="flex flex-wrap justify-center">
            <div class="w-full p-6">

                @if (session('status'))
                    <div class="bg-green-500 text-white font-bold rounded p-4 mb-4" role="alert">{{ session('status') }}</div>
                @endif

                <div class="bg-white shadow-md rounded p-4">
                    <div class="flex justify-between mb-4">
                        <h4 class="text-lg font-bold">Projects</h4>
                        <div>
                            @can('delete project')
                            <a href="{{ url('projects/trash') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Recycling Bin</a>
                            @endcan
                            @can('create project')
                            <a href="{{ url('projects/create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Post Project</a>
                            @endcan
                        </div>
                    </div>
                    <div class="overflow-x-auto">
                        <div class="grid grid-cols-3 gap-4 text-gray-500">
                            @foreach ($projects as $project)
                            <div class="bg-gray-100 border-b mb-5 p-4">
                                <h5 class="text-lg font-bold">{{ $project->title }}</h5>
                                <p>{{ Str::limit($project->description, 200) }}</p>
                                <p class="mt-10">{{ 'Posted By: ' }}<b>{{ $project->posted_by }}</b></p>
                                <p>{{ 'Posted On: ' }}<b>{{ date('M d, Y', strtotime($project->posted_on)) }}</b></p>
                                <div class="text-center mt-10">
                                    <a href={{ url('projects/'.$project->id.'/show')}} class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">View More</a>
                                </div>
                                @can('update project')
                                <div class="text-center mt-5">
                                    <a href="{{ url('projects/'.$project->id.'/edit') }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Edit</a>
                                    <a href="{{ url('projects/'.$project->id.'/delete') }}" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded" onclick="return confirm('Are you sure you want to delete this project?')">Delete</a>
                                </div>
                                @endcan
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>