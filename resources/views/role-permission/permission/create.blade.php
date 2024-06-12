<x-app-layout>
    <div class="container mx-auto p-5">
        <div class="flex flex-wrap justify-center">
            <div class="w-full p-6">
                <div class="bg-white shadow-md rounded p-4">
                    <div class="flex justify-between mb-4">
                        <h4 class="text-lg font-bold">Create Permissions</h4>
                        <a href="{{ url('permissions') }}" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded float-right">Back</a>
                    </div>
                    <div class="p-4">
                        <form action="{{ url('permissions') }}" method="POST">
                            @csrf
                            <div class="mb-4">
                                <label for="" class="block mb-2 text-sm font-bold">Permission Name</label>
                                <input type="text" name="name" class="w-full pl-10 text-sm text-gray-700"/>
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