<x-app-layout>
    <div class="container mx-auto p-5">
        <div class="flex flex-wrap justify-center">
            <div class="w-full p-6">
                <div class="bg-white shadow-md rounded p-4">
                    <div class="flex justify-between mb-4">
                        <h4 class="text-lg font-bold">Edit Job</h4>
                        <a href="{{ url('jobs') }}" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Back</a>
                    </div>
                    <div class="p-4">
                        <form action="{{ url('jobs/'.$job->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="mb-4">
                                <label for="" class="block mb-2 text-sm font-bold">Title</label>
                                <input type="text" name="title" value="{{ $job->title }}" class="w-full p-2 pl-10 text-sm text-gray-700"/>

                                @error('title')
                                    <span class="text-xs text-red-600">{{ $message }}</span>
                                @enderror

                            </div>
                            <div class="mb-4">
                                <label for="" class="block mb-2 text-sm font-bold">Description</label>
                                <textarea name="description" value="{{ $job->description }}" class="w-full p-2 pl-10 text-sm text-gray-700"></textarea>
                            </div>
                            <div class="mb-4">
                                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>