<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Job Applications') }}
        </h2>
    </x-slot>

    <div class="py-12">
        @if (session('status'))
        <div class="max-w-7xl mx-auto bg-green-500 text-white font-bold rounded p-4 mb-4" role="alert">{{ session('status') }}</div>
        @endif

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h2 class="text-2xl font-semibold mb-4">{{ __('Applications') }}</h2>
                    @if($applications->isEmpty())
                        <p class="text-gray-600">{{ __('You have not applied to any jobs yet.') }}</p>
                    @else
                        <div class="space-y-4">
                            @foreach ($applications as $application)
                            <div class="bg-gray-100 p-4 rounded-lg shadow-md">
                                <h3 class="text-xl font-semibold text-gray-800 mb-2">{{ $application->job->title }}</h3>
                                <p class="text-gray-600 mb-2">Name: <b>{{ $application->name }}</b></p>
                                <p class="text-gray-600 mb-2">Email: <b>{{ $application->email }}</b></p>
                                <p class="text-gray-600 mb-2">Resume: <a href="{{ Storage::url($application->resume) }}" class="text-blue-500 hover:underline" target="_blank">{{ __('View Resume') }}</a></p>
                                <p class="text-gray-600 mb-2">Cover Letter: <p class="bg-white p-4 border rounded-lg shadow-sm text-gray-700">{{ $application->cover_letter }}</p></p>
                                <p class="text-gray-600 mb-2">Applied On: <b>{{ $application->created_at->format('M d, Y') }}</b></p>
                                
                                <!-- Status -->
                                <p class="text-gray-600 mb-2">Status: 
                                    @if($application->status == 'pending')
                                        <span class="text-yellow-600">Pending</span>
                                    @elseif($application->status == 'reviewed')
                                        <span class="text-blue-600">Reviewed</span>
                                    @elseif($application->status == 'approved')
                                        <span class="text-green-600">Approved</span>
                                    @endif
                                </p>
                            </div>
                        @endforeach
                        
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
