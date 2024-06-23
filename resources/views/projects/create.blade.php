<x-app-layout>
    <div class="container mx-auto p-5">
        <div class="flex flex-wrap justify-center">
            <div class="w-full p-6">
                <div class="bg-white shadow-md rounded p-4">
                    <div class="flex justify-between mb-4">
                        <h4 class="text-lg font-bold">Create Project</h4>
                        <a href="{{ url('projects') }}" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Back</a>
                    </div>
                    <div class="p-4">
                        <form action="{{ url('projects') }}" method="POST">
                            @csrf
                            
                            <div class="mb-4">
                                <label for="" class="block mb-2 text-sm font-bold">Title</label>
                                <input type="text" name="title" class="w-full p-2 pl-10 text-sm text-gray-700"/>
                            </div>
                            <div class="mb-4">
                                <label for="" class="block mb-2 text-sm font-bold">Description</label>
                                <textarea name="description" class="w-full p-2 pl-10 text-sm text-gray-700"></textarea>
                            </div>
                            <div class="mb-4">
                                <label for="" class="block mb-2 text-sm font-bold">Project Type</label>
                                <div class="flex items-center">
                                    <input type="radio" name="is_private" value="0" id="public_project" class="mr-2" checked>
                                    <label for="public_project" class="text-sm text-gray-700">Public</label>
                                    <input type="radio" name="is_private" value="1" id="private_project" class="mr-2 ml-4">
                                    <label for="private_project" class="text-sm text-gray-700">Private</label>
                                </div>
                            </div>
                            <div class="mb-4">
                                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>