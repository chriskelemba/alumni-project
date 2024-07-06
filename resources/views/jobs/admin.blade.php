<x-app-layout>
    <div class="container mx-auto p-5">
        <div class="flex flex-wrap justify-center">
            <div class="w-full p-6">

                @if (session('status'))
                    <div class="bg-green-500 text-white font-bold rounded p-4 mb-4" role="alert">{{ session('status') }}</div>
                @endif

                <div class="bg-white shadow-md rounded p-4">
                    <div class="flex justify-between mb-4">
                        <h4 class="text-lg font-bold">Jobs</h4>
                        <form action="{{ url('jobs') }}" method="GET">
                            <input type="search" name="search" placeholder="Search for a job" class="bg-gray-100">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Search</button>
                        </form>
                        <div>
                            <a href="{{ url('jobs') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Back</a>
                            @can('delete job')
                            <a href="{{ url('jobs/trash') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Recycling Bin</a>
                            @endcan
                            @can('create job')
                            <a href="{{ url('jobs/create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Post Job</a>
                            @endcan
                        </div>
                    </div>
                    <div class="overflow-x-auto">
                        <div class="grid grid-cols-3 gap-4 text-gray-500">
                            @foreach ($jobs as $job)
                            <div class="bg-gray-100 border-b mb-5 p-4">
                                <h5 class="text-lg font-bold">{{ $job->title }}</h5>
                                <p>{{ Str::limit($job->description, 200) }}</p>
                                <br>
                                <p class="text-center">
                                    @if($job->skills->count() > 0)
                                        @foreach($job->skills as $skill)
                                            <span class="bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2">{{ $skill->name }}</span>
                                        @endforeach
                                    @else
                                        {{ __("No skills required.") }}
                                    @endif
                                </p>
                                <div class="text-center mt-10">
                                    <a href={{ url('jobs/'.$job->id.'/show')}} class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">View More</a>
                                </div>
                                @can('update job')
                                <div class="text-center mt-5">
                                    <a href="{{ url('jobs/'.$job->id.'/edit') }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Edit</a>
                                    <a href="{{ url('jobs/'.$job->id.'/delete') }}" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded" onclick="return confirm('Are you sure you want to delete this job?')">Delete</a>
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