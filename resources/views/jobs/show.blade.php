<x-app-layout>
    <div class="container mx-auto p-5">
        <div class="flex flex-wrap justify-center">
            <div class="w-full p-6">
                <div class="bg-white shadow-md rounded py-16 px-40">
                    <div class="mb-8 flex justify-center">
                        <x-danger-button class="bg-white hover:bg-white text-white py-2 px-4" disabled>Back</x-danger-button>
                        <h1 class="text-gray-800 text-4xl flex-1 text-center font-bold">{{ $job->title }}</h1>
                        <a href="{{ url('jobs') }}">
                            <x-danger-button>{{ __('Back') }}</x-danger-button>
                        </a>
                    </div>    
                    <h1 class="text-gray-600 text-center text-2xl font-bold p-5 mt-10">Job Description</h1>
                    <p class="text-gray-600">{{ $job->description }}</p>
                    <h1 class="text-gray-600 text-center text-2xl font-bold p-5 mt-10">Responsibilities</h1>
                    <p class="text-gray-600">{{ $job->responsibilities }}</p>
                    <h1 class="text-gray-600 text-center text-2xl font-bold p-5 mt-10">Qualifications</h1>
                    <p class="text-gray-600">{{ $job->qualifications }}</p>
                    <h1 class="text-gray-600 text-center text-2xl font-bold p-5 mt-10">About Us</h1>
                    <p class="text-gray-600">{{ $job->aboutus }}</p>
                    <div class="text-center mb-12 mt-14">
                        <a href="{{ url('jobs/'.$job->id.'/apply') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-3 px-12 rounded">APPLY NOW</a>
                    </div>
                    <a href="{{ url('jobs/'.$job->id.'/feedback')}}">
                        <x-primary-button>{{ __('Feedback') }}</x-primary-button>
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>