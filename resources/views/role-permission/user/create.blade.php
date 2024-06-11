<x-app-layout>
    <div class="container mx-auto p-5">
        <div class="flex flex-wrap justify-center">
            <div class="w-full lg:w-1/2 xl:w-1/3 p-6">
                <div class="bg-white shadow-md rounded p-4">
                    <div class="flex justify-between mb-4">
                        <h4 class="text-lg font-bold">Create User</h4>
                        <a href="{{ url('users') }}" class="bg-red-500 hover:bg-red-700 text-black font-bold py-2 px-4 rounded">Back</a>
                    </div>
                    <div class="p-4">
                        <form action="{{ url('users') }}" method="POST">
                            @csrf
                            
                            <div class="mb-4">
                                <label for="" class="block mb-2 text-sm font-bold">Name</label>
                                <input type="text" name="name" class="w-full p-2 pl-10 text-sm text-gray-700"/>
                            </div>
                            <div class="mb-4">
                                <label for="" class="block mb-2 text-sm font-bold">Email</label>
                                <input type="email" name="email" class="w-full p-2 pl-10 text-sm text-gray-700"/>
                            </div>
                            <div class="mb-4">
                                <label for="" class="block mb-2 text-sm font-bold">Password</label>
                                <input type="password" name="password" class="w-full p-2 pl-10 text-sm text-gray-700"/>
                            </div>
                            <div class="mb-4">
                                <label for="" class="block mb-2 text-sm font-bold">Roles</label>
                                <select name="roles[]" class="w-full p-2 pl-10 text-sm text-gray-700" multiple>
                                    <option value="">Select Role</option>

                                    @foreach ($roles as $role)
                                        <option value="{{ $role }}">{{ $role }}</option>
                                    @endforeach

                                </select>
                            </div>
                            <div class="mb-4">
                                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-black font-bold py-2 px-4 rounded">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>