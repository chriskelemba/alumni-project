<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        @if (session('status'))
        <div class="max-w-7xl mx-auto bg-green-500 text-white font-bold rounded p-4 mb-4" role="alert">{{ session('status') }}</div>
        @endif

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __('Welcome, ') }}<b>{{ auth()->user()->name }}</b>{{ __('.') }}
                </div>
                @role('alumni')
                <div class="pb-6 px-6">
                    <a href="{{ url('profile/'.auth()->user()->id) }}">
                        <x-primary-button>
                            {{ __('View your Profile') }}
                        </x-primary-button>
                    </a>
                </div>
                <!-- Alumni Dashboard Section -->
                <div class="pb-6 px-6">
                    <h2 class="text-2xl font-semibold text-gray-800 mb-4">{{ __('Alumni Dashboard') }}</h2>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div class="bg-blue-100 p-4 rounded-lg shadow">
                            <h3 class="text-xl font-semibold text-gray-700">{{ __('Jobs') }}</h3>
                            <a href="{{ url('/jobs') }}">
                                <x-primary-button class="mt-4">
                                    {{ __('View Jobs') }}
                                </x-primary-button>
                            </a>
                        </div>
                        <div class="bg-green-100 p-4 rounded-lg shadow">
                            <h3 class="text-xl font-semibold text-gray-700">{{ __('Projects') }}</h3>
                            <a href="{{ url('/projects') }}">
                                <x-primary-button class="mt-4">
                                    {{ __('View Published Projects') }}
                                </x-primary-button>
                            </a>
                        </div>
                        <div class="bg-yellow-100 p-4 rounded-lg shadow">
                            <h3 class="text-xl font-semibold text-gray-700">{{ __('Messages') }}</h3>
                            <a href="{{ url('/messages') }}">
                                <x-primary-button class="mt-4">
                                    {{ __('View Messages') }}
                                </x-primary-button>
                            </a>
                        </div>
                    </div>
                </div>
                @endrole
            </div>
        </div>

        @role('super-admin|admin')
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-8">
            <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                <div class="p-6">
                    <h1 class="text-3xl font-extrabold text-gray-800 mb-4">Skills</h1>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="bg-blue-100 p-4 rounded-lg shadow">
                            <h2 class="text-xl font-semibold text-gray-700">Skills</h2>
                            <a href="{{ url('/skills') }}">
                                <x-primary-button class="mt-4">
                                    View Skills
                                </x-primary-button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                <div class="p-6">
                    @php
                        $totalApplications = \App\Models\Application::count();
                        $totalJobFeedback = \App\Models\JobFeedback::count();
                    @endphp
                    <h1 class="text-3xl font-extrabold text-gray-800 mb-4">Job Analytics</h1>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="bg-blue-100 p-4 rounded-lg shadow">
                            <h2 class="text-xl font-semibold text-gray-700">Total Job Applications</h2>
                            <p class="text-2xl font-bold text-blue-600">{{ $totalApplications }}</p>
                            <a href="{{ route('show-applications') }}">
                                <x-primary-button class="mt-4">
                                    View Applications
                                </x-primary-button>
                            </a>
                        </div>
                        <div class="bg-green-100 p-4 rounded-lg shadow">
                            <h2 class="text-xl font-semibold text-gray-700">Total Job Feedbacks</h2>
                            <p class="text-2xl font-bold text-green-600">{{ $totalJobFeedback }}</p>
                            <a href="{{ url('profile/view') }}">
                                <x-primary-button class="mt-4">
                                    View Feedbacks
                                </x-primary-button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endrole
        
    </div>
</x-app-layout>
