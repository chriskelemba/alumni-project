<x-app-layout>
    <div class="container mx-auto p-5">
        <div class="flex flex-wrap justify-center">
            <div class="w-full p-6">
                <div class="bg-white shadow-md rounded p-4">

                    <div class="flex justify-between mb-4">
                        <h4 class="text-lg font-bold">Recycling Bin</h4>
                        <a href="{{ url('users') }}" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Back</a>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-center text-gray-500">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                <tr>
                                    <th class="py-3 px-6">Id</th>
                                    <th class="py-3 px-6">Name</th>
                                    <th class="py-3 px-6">Email</th>
                                    <th class="py-3 px-6">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($trashedUsers as $trashedUser)
                                <tr class="bg-white border-b">
                                    <td class="py-4 px-6">{{ $trashedUser->id }}</td>
                                    <td class="py-4 px-6">{{ $trashedUser->name }}</td>
                                    <td class="py-4 px-6">{{ $trashedUser->email }}</td>
                                    <td class="py-4 px-6">
                                        <a href="{{ url('users/'.$trashedUser->id.'/restore') }}" class="bg-orange-500 hover:bg-orange-700 text-white font-bold py-2 px-4 rounded">Restore</a>
                                        <a href="{{ url('users/'.$trashedUser->id.'/forceDelete') }}" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Delete Permanently</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>