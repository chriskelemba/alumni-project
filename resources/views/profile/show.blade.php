<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <div class="flex justify-between">
                {{ __('Profile') }}
                @role('super-admin|admin|employee')
                <a href="{{ url('/users') }}">
                    <x-danger-button>{{ __('Back to alumnis') }}</x-danger-button>
                </a>
                @endrole
            </div>
        </h2>
    </x-slot>

    @if (session('status'))
        <div class="max-w-7xl mx-auto mt-3 bg-green-500 text-white font-bold rounded p-4 mb-4" role="alert">{{ session('status') }}</div>
    @endif

    @if ($errors->any())
        <div class="max-w-7xl mx-auto mt-3 bg-red-500 text-white font-bold rounded p-4 mb-4">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="">
                    @include('profile.partials.profile')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="">
                    @include('profile.partials.portfolio')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="">
                    @include('profile.partials.projects')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
