<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ ('Jobs') }}
        </h2>
    </x-slot>
    <div class="container mx-auto p-5">
        <div class="flex flex-wrap justify-center">
            <div class="w-full p-6">

                @if (session('status'))
                    <div class="bg-green-500 text-white font-bold rounded p-4 mb-4" role="alert">{{ session('status') }}</div>
                @endif

                <div class="bg-white shadow-md rounded p-4">
                    <div class="flex justify-between mb-4">
                        <form action="{{ url('jobs') }}" method="GET">
                            <input type="search" name="search" placeholder="Search for a job" class="bg-gray-100">
                            <x-primary-button>Search</x-primary-button>
                        </form>
                        <div class="flex justify-between">
                            <div class="mx-2">
                                @role('super-admin|admin')
                                @can('delete job')
                                <a href="{{ url('jobs/trash') }}">
                                    <x-primary-button>{{ __('Recycling Bin') }}</x-primary-button>
                                </a>
                                @endcan
                                @can('create job')
                                <a href="{{ url('jobs/create') }}">
                                    <x-primary-button>{{ __('Post Job') }}</x-primary-button>
                                </a>
                                @endcan
                                @endrole
                            </div>
                            @role('alumni')
                            @if(request()->has('filter_skills'))
                                <a href="{{ url('jobs') }}">
                                    <x-primary-button>Show All Jobs</x-primary-button>
                                </a>
                            @else
                                <form action="{{ url('jobs') }}" method="GET">
                                    <input type="hidden" name="filter_skills" value="1">
                                    <x-primary-button>{{__('Filter by My Skills')}}</x-primary-button>
                                </form>
                            @endif
                            @endrole
                        </div>
                    </div>
                    <div class="overflow-x-auto">
                        <div class="grid grid-cols-3 gap-4 text-gray-500">
                            @foreach ($jobs as $index => $job)
                            <div class="border mb-5 p-2 rounded-3xl">
                                @php
                                    $colors = ['bg-red-100', 'bg-yellow-100', 'bg-blue-100', 'bg-green-100', 'bg-purple-100'];
                                    $color = $colors[$index % count($colors)];
                                @endphp
                                <div class="{{ $color }} p-5 rounded-3xl">
                                    <p class="mb-8"><b class="bg-white p-2 rounded-3xl">{{ date('d M, Y', strtotime($job->created_at)) }}</b></p>
                                    <p>{{ $job->company }}</p>
                                    <div class="flex items-center">
                                        <h5 class="text-2xl font-bold mb-3 flex-grow">{{ $job->title }}</h5>
                                        @if ($job->logo)
                                        <img src="{{ Storage::url($job->logo) }}" alt="Logo" class="rounded-full h-20 w-20 object-cover">
                                        @endif
                                    </div>                                    
                                    <br>
                                    <p class="text-center">
                                        @if($job->skills->count() > 0)
                                            @foreach($job->skills as $skill)
                                                <span class="border bg-white rounded-full px-3 py-1 text-sm font-semibold mr-2">{{ $skill->name }}</span>
                                            @endforeach
                                        @else
                                            {{ __("No skills required.") }}
                                        @endif
                                    </p>
                                </div>
                                <div class="p-5 flex justify-between">
                                    <div>
                                        <p>{{ $job->location }}</p>
                                        <p class="flex">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-fill mr-1 mt-1" viewBox="0 0 16 16">
                                                <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0"/>
                                                <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8m8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7"/>
                                            </svg>
                                            {{ $job->views_count }}
                                        </p>
                                    </div>
                                    @can('update job')
                                    <a href="{{ url('jobs/'.$job->id.'/edit') }}">
                                        <x-secondary-button>{{ __('Edit') }}</x-secondary-button>
                                    </a>
                                    <a href="{{ url('jobs/'.$job->id.'/delete') }}" onclick="return confirm('Are you sure you want to delete this job?')">
                                        <x-danger-button>{{ __('Delete') }}</x-danger-button>
                                    </a>
                                    @endcan  
                                    <a href="{{ url('jobs/'.$job->id.'/show')}}">
                                        <x-primary-button>{{ __('Details') }}</x-primary-button>
                                    </a>                                  
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="mt-4">
                        {{ $jobs->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
