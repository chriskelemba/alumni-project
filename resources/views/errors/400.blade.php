<x-error-layout>
    <div class="flex flex-col items-center justify-center bg-gray-100 text-gray-800">
        <div class="text-5xl font-bold text-yellow-500 mb-4">400</div>
        <div class="text-2xl font-semibold mb-4">Bad Request</div>
        <p class="text-lg text-gray-600 mb-8 text-center">
            Sorry, your request could not be processed.
        </p>
        <a href="{{ url('/') }}">
            <x-primary-button>{{ __('Go to Homepage') }}</x-primary-button>
        </a>
    </div>
</x-error-layout>
