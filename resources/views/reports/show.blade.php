<x-app-layout>
    <div class="container mx-auto p-5">
        <div class="flex flex-wrap justify-center">
            <div class="w-full p-6">
                <div class="bg-white shadow-md rounded-lg p-8">
                    <div class="flex justify-between items-center mb-6">
                        <h1 class="text-2xl font-bold text-gray-800">Application Details</h1>
                        <a href="{{ url('applications') }}">
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

                    <div class="mt-6">
                        <p class="text-gray-700 mb-4">Status: 
                            @if($application->status == 'pending')
                                <span class="bg-yellow-100 text-yellow-800 text-xs font-bold mr-2 px-2.5 py-0.5 rounded">{{ __('Pending') }}</span>
                            @elseif($application->status == 'reviewed')
                                <span class="bg-blue-100 text-blue-800 text-xs font-bold mr-2 px-2.5 py-0.5 rounded">{{ __('Reviewed') }}</span>
                            @elseif($application->status == 'approved')
                                <span class="bg-green-100 text-green-800 text-xs font-bold mr-2 px-2.5 py-0.5 rounded">{{ __('Approved') }}</span>
                            @elseif($application->status == 'denied')
                                <span class="bg-red-100 text-red-800 text-xs font-bold mr-2 px-2.5 py-0.5 rounded">{{ __('Denied') }}</span>
                            @endif
                        </p>
                        @if($application->status == 'pending')
                            <div class="flex space-x-4">
                                <a href="{{ route('application.review', $application->id) }}">
                                    <x-secondary-button>{{ __('Review') }}</x-secondary-button>
                                </a>
                                <a href="{{ route('application.approve', $application->id) }}">
                                    <x-primary-button>{{ __('Approve') }}</x-primary-button>
                                </a>
                                <a href="{{ route('application.deny', $application->id) }}">
                                    <x-danger-button>{{ __('Deny') }}</x-danger-button>
                                </a>
                            </div>
                        @endif
                        @if($application->status == 'reviewed')
                            <a href="{{ route('application.approve', $application->id) }}">
                                <x-primary-button>{{ __('Approve') }}</x-primary-button>
                            </a>
                            <a href="{{ route('application.deny', $application->id) }}">
                                <x-danger-button>{{ __('Deny') }}</x-danger-button>
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
