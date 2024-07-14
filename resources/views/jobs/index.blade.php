<x-app-layout>
    <div class="container mx-auto p-5">
        <div class="flex flex-wrap justify-center">
            <div class="w-full p-6">

                @if (session('status'))
                    <div class="bg-green-500 text-white font-bold rounded p-4 mb-4" role="alert">{{ session('status') }}</div>
                @endif

                <div class="bg-white shadow-md rounded p-4">
                    <div class="flex justify-between mb-4">
                        <h4 class="text-lg font-bold">Jobs</h4>
                        <form action="{{ url('jobs') }}" method="GET">
                            <input type="search" name="search" placeholder="Search for a job" class="bg-gray-100">
                            <x-primary-button>Search</x-primary-button>
                        </form>
                        <div>
                            @role('super-admin|admin')
                            <a href="{{ url('jobs/admin') }}">
                                <x-primary-button>{{ __('Admin') }}</x-primary-button>
                            </a>
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
                                    <h5 class="text-2xl font-bold mb-3">{{ $job->title }}</h5>
                                    {{-- <p>{{ Str::limit($job->description, 200) }}</p> --}}
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
                                    </div>
                                    <a href="{{ url('jobs/'.$job->id.'/show')}}">
                                        <x-primary-button>{{ __('Details') }}</x-primary-button>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>