<x-app-layout>
    <div class="container mx-auto p-5">
        <div class="flex flex-wrap justify-center">
            <div class="w-full p-6">

                @if (session('status'))
                    <div class="bg-green-500 text-white font-bold py-2 px-4 rounded mb-4">{{ session('status') }}</div>
                @endif

                <div class="bg-white shadow-md rounded p-4">
                    <div class="flex justify-between mb-4">
                        <span class="bg-gray-100 text-black-700 text-sm font-bold mr-2 px-2.5 py-0.5 uppercase rounded">Job Applications</span>
                        <a href="{{ url('/dashboard') }}">
                            <x-danger-button>{{ __('Back') }}</x-danger-button>
                        </a>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-center text-gray-500">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                <tr>
                                    <th class="py-3 px-6">Name</th>
                                    <th class="py-3 px-6">Email</th>
                                    <th class="py-3 px-6">Resume</th>
                                    <th class="py-3 px-6">Cover Letter</th>
                                    <th class="py-3 px-6">Status</th>
                                    <th class="py-3 px-6">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($applications as $application)
                                    <tr class="bg-white border-b">
                                        <td class="py-4 px-6">{{ $application->name }}</td>
                                        <td class="py-4 px-6">{{ $application->email }}</td>
                                        <td class="py-4 px-6">
                                            <a href="{{ url('storage/'.$application->resume) }}" class="text-blue-500 hover:underline" target="_blank">View Resume</a>
                                        </td>
                                        <td class="py-4 px-6">
                                            <a href="{{ url('storage/cover_letters/'.$application->cover_letter) }}" class="text-blue-500 hover:underline" target="_blank">View Cover Letter</a>
                                        </td>
                                        <td class="py-4 px-6">
                                            @if($application->status == 'pending')
                                                <span class="bg-yellow-100 text-yellow-800 text-xs font-bold mr-2 px-2.5 py-0.5 rounded">{{ __('Pending') }}</span>
                                            @elseif($application->status == 'reviewed')
                                                <span class="bg-blue-100 text-blue-800 text-xs font-bold mr-2 px-2.5 py-0.5 rounded">{{ __('Reviewed') }}</span>
                                            @elseif($application->status == 'approved')
                                                <span class="bg-green-100 text-green-800 text-xs font-bold mr-2 px-2.5 py-0.5 rounded">{{ __('Approved') }}</span>
                                            @elseif($application->status == 'denied')
                                                <span class="bg-red-100 text-red-800 text-xs font-bold mr-2 px-2.5 py-0.5 rounded">{{ __('Denied') }}</span>
                                            @endif
                                        </td>                                        
                                        <td class="py-4 px-6">
                                            <a href= "{{ route('applications.show', $application->id) }}">
                                                <x-primary-button>{{ __('Details') }}</x-primary-button>
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
