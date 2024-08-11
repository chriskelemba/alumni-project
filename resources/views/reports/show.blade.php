<x-app-layout>
    <div class="container mx-auto p-5">
        <div class="flex flex-wrap justify-center">
            <div class="w-full p-6">
                <div class="bg-white shadow-md rounded-lg p-8">
                    <div class="flex justify-between items-center mb-6">
                        <h1 class="text-2xl font-bold text-gray-800">Application Details</h1>
                        <a href="{{ url()->previous() }}">
                            <x-danger-button>{{ __('Back') }}</x-danger-button>
                        </a>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-6">
                        <div class="bg-gray-100 p-4 rounded-lg shadow-inner">
                            <h2 class="text-lg font-semibold text-gray-700">Name</h2>
                            <p class="text-gray-900">{{ $application->name }}</p>
                        </div>
                        <div class="bg-gray-100 p-4 rounded-lg shadow-inner">
                            <h2 class="text-lg font-semibold text-gray-700">Email</h2>
                            <p class="text-gray-900">{{ $application->email }}</p>
                        </div>
                        <div class="bg-gray-100 p-4 rounded-lg shadow-inner">
                            <h2 class="text-lg font-semibold text-gray-700">Resume</h2>
                            <a href="{{ Storage::url($application->resume) }}" class="text-blue-500 hover:underline" target="_blank">View Resume</a>
                        </div>
                        <div class="bg-gray-100 p-4 rounded-lg shadow-inner">
                            <h2 class="text-lg font-semibold text-gray-700">Cover Letter</h2>
                            <p class="text-gray-900">{{ $application->cover_letter }}</p>
                        </div>
                    </div>

                    <!-- Status and Actions -->
                    <div class="mt-6">
                        <p class="text-gray-700 mb-4">Status: 
                            @if($application->status == 'pending')
                                <span class="text-yellow-600">Pending</span>
                            @elseif($application->status == 'reviewed')
                                <span class="text-blue-600">Reviewed</span>
                            @elseif($application->status == 'approved')
                                <span class="text-green-600">Approved</span>
                            @endif
                        </p>
                        @if($application->status == 'pending')
                            <div class="flex space-x-4">
                                <a href="{{ route('admin.application.review', $application->id) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded">Review</a>
                                <a href="{{ route('admin.application.approve', $application->id) }}" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded">Approve</a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
