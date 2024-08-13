<x-error-layout>
    <div class="flex flex-col items-center justify-center bg-gray-100 text-gray-800">
        <div class="text-5xl font-bold text-red-500 mb-4">404</div>
        <div class="text-2xl font-semibold mb-4">Oops! Page Not Found</div>
        <p class="text-lg text-gray-600 mb-8 text-center">
            Sorry, the page you're looking for doesn't exist or has been moved.
        </p>
        <a href="{{ url('/') }}">
            <x-primary-button>{{ __('Go to Homepage') }}</x-primary-button>
        </a>
    </div>
</x-error-layout>
