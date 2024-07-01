<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ ('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        {{-- @if (session('status'))
        <div class="bg-green-500 text-white font-bold rounded p-4 mb-4" role="alert">{{ session('status') }}</div>
    @endif --}}

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ ("You are logged in as ") }}<b>{{ auth()->user()->roles->first()->name }}</b>{{ (".") }}
                </div>
                <div class="pb-6 px-6">
                    <a href="{{ url('profile/view') }}">
                        <x-primary-button>
                            {{ "View your Profile"}}
                        </x-primary-button>
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
