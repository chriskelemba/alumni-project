<x-app-layout>
    <div class="container mx-auto p-5">
        <div class="flex flex-wrap justify-center">
            <div class="w-full p-6">
                <div class="bg-white shadow-md rounded p-4">
                    <div class="flex justify-between mb-4">
                        <h4 class="text-lg font-bold">Create Job</h4>
                        <a href="{{ url('jobs/admin') }}" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Back</a>
                    </div>
                    <div class="p-4">
                        <form action="{{ url('jobs') }}" method="POST">
                            @csrf
                            
                            <div class="mb-4">
                                <label for="" class="block mb-2 text-sm font-bold">Title</label>
                                <input type="text" name="title" class="w-full p-2 pl-10 text-sm text-gray-700"/>
                            </div>
                            <div class="mb-4">
                                <label for="" class="block mb-2 text-sm font-bold">Company</label>
                                <input type="text" name="company" class="w-full p-2 pl-10 text-sm text-gray-700"/>
                            </div>
                            <div class="mb-4">
                                <label for="" class="block mb-2 text-sm font-bold">Location</label>
                                <input type="text" name="location" class="w-full p-2 pl-10 text-sm text-gray-700"/>
                            </div>
                            <div class="mb-4">
                                <label for="" class="block mb-2 text-sm font-bold">Description</label>
                                <textarea name="description" class="w-full p-2 pl-10 text-sm text-gray-700"></textarea>
                            </div>
                            <div class="mb-4">
                                <label for="" class="block mb-2 text-sm font-bold">Responsibilities</label>
                                <textarea name="responsibilities" class="w-full p-2 pl-10 text-sm text-gray-700"></textarea>
                            </div>
                            <div class="mb-4">
                                <label for="" class="block mb-2 text-sm font-bold">Qualifications</label>
                                <textarea name="qualifications" class="w-full p-2 pl-10 text-sm text-gray-700"></textarea>
                            </div>
                            <div class="mb-4">
                                <label for="" class="block mb-2 text-sm font-bold">About Us</label>
                                <textarea name="aboutus" class="w-full p-2 pl-10 text-sm text-gray-700"></textarea>
                            </div>
                            <div class="mb-4">
                                <label for="" class="block mb-2 text-sm font-bold">Skills</label>
                                @foreach ($skills as $skill)
                                <div class="w-1/2 md:w-1/3 xl:w-1/4 p-2">
                                    <label>
                                        <input type="checkbox"
                                        name="skills[]"
                                        value="{{ $skill->name }}"  
                                        />
                                        {{ $skill->name }}
                                    </label>
                                </div>
                                @endforeach
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