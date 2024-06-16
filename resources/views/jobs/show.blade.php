<x-app-layout>
    <div class="container mx-auto p-5">
        <div class="flex flex-wrap justify-center">
            <div class="w-full p-6">
                <div class="bg-white shadow-md rounded p-4">
                    <div class="flex justify-between mb-4">
                        <h4 class="text-center text-3xl text-bold">{{ $job->title }}</h4>
                        <a href="{{ url('jobs') }}" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Back</a>
                    </div>
                    <p class="text-gray-600">{{ $job->description }}</p>
                    <div class="text-center mb-4 mt-6">
                        <a href="{{ url('jobs/'.$job->id.'/apply') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Apply</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>