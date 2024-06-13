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
                        <a href="{{ url('jobs/create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Add Job</a>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-center text-gray-500">
                            <tbody>
                                @foreach ($jobs as $job)
                                <tr class="bg-gray-100 border-b">
                                    <td class="py-4 px-6 text-xs text-gray-700 uppercase">{{ $job->id }}</td>
                                    <td class="py-4 px-6">{{ $job->title }}</td>
                                    <td class="py-4 px-6">{{ $job->description }}</td>
                                    <td class="py-4 px-6 flex">
                                            <a href="{{ url('jobs/'.$job->id.'/edit') }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Edit</a>
                                            <a href="{{ url('jobs/'.$job->id.'/delete') }}" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded" onclick="return confirm('Are you sure you want to delete this job?')">Delete</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="text-center mb-4 mt-6">
                        <a href="{{ url('jobs/trash') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Recycling Bin</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>