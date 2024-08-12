<x-app-layout>
    <div class="container mx-auto p-6">
        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <div class="p-6">
                <h1 class="text-2xl font-bold text-gray-800 mb-4">{{ __('Job Feedback Details') }}</h1>
                <div class="mb-4">
                    <h2 class="text-lg font-semibold text-gray-700">{{ __('Job Title: ') }}{{ $feedback->job->title }}</h2>
                </div>
                <div class="mb-4">
                    <h3 class="text-md font-medium text-gray-600">{{ __('Submitted by: ') }}{{ $feedback->user->name }}</h3>
                    <p class="text-gray-500 text-sm">{{ $feedback->created_at->format('d/m/Y H:i') }}</p>
                </div>
                <div class="bg-gray-50 p-4 rounded-lg">
                    <p class="text-gray-700">{{ $feedback->feedback_text }}</p>
                </div>
                <div class="mt-6">
                    <a href="{{ route('feedback.index') }}">
                        <x-primary-button>{{ __('Back to Feedbacks') }}</x-primary-button>
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>