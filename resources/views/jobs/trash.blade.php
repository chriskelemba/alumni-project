<x-app-layout>
    <div class="container mx-auto p-5">
        <div class="flex flex-wrap justify-center">
            <div class="w-full p-6">

                @if (session('status'))
                <div class="bg-green-500 text-white font-bold rounded p-4 mb-4" role="alert">{{ session('status') }}</div>
                @endif

                <div class="bg-white shadow-md rounded p-4">

                    <div class="flex justify-between mb-4">
                        <h4 class="text-lg font-bold">Recycling Bin</h4>
                        <a href="{{ url('jobs') }}">
                            <x-danger-button>{{ __('Back') }}</x-danger-button>
                        </a>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-center text-gray-500">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                <tr>
                                    <th class="py-3 px-6">Id</th>
                                    <th class="py-3 px-6">Title</th>
                                    <th class="py-3 px-6">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($trashedJobs as $trashedJob)
                                <tr class="bg-white border-b">
                                    <td class="py-4 px-6">{{ $trashedJob->id }}</td>
                                    <td class="py-4 px-6">{{ $trashedJob->title }}</td>
                                    <td class="py-4 px-6">
                                        <a href="{{ url('jobs/'.$trashedJob->id.'/restore') }}">
                                            <x-secondary-button>{{ __('Restore') }}</x-secondary-button>
                                        </a>
                                        <a href="{{ url('jobs/'.$trashedJob->id.'/forceDelete') }}" onclick="return confirm('Are you sure you want to delete this job?')">
                                            <x-danger-button>{{ __('Delete Permanently') }}</x-danger-button>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
