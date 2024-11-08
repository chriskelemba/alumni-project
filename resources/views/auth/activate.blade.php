<x-guest-layout>
    @if (session('error'))
        <p class="text-red-500">{{ session('error') }}</p>
    @endif
    <form method="POST" action="{{ route('set-password', $token) }}">
        @csrf

        <h1 class="font-bold text-xl mb-5">Create a Password</h1>
        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"/>

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->                        
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation"/>

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button class="ms-3">
                {{ __('Activate Account') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>