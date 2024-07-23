<x-guest-layout>
    @if (session('error'))
        <p class="text-red-500">{{ session('error') }}</p>
    @endif
    <form method="POST" action="{{ route('reactivate', $token) }}">
        @csrf
        <h1 class="font-extrabold">Click the button below to Activate your account.</h1>
        <div class="flex items-center justify-end mt-4">
            <x-primary-button class="ms-3">
                {{ __('Activate Account') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>