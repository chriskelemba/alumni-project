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
                            <a href="{{ url('storage/'.$application->resume) }}" class="text-blue-500 hover:underline" target="_blank">View Resume</a>
                        </div>
                        <div class="bg-gray-100 p-4 rounded-lg shadow-inner">
                            <h2 class="text-lg font-semibold text-gray-700">Cover Letter</h2>
                            <p class="text-gray-900">{{ $application->cover_letter }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
