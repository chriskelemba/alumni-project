<x-app-layout>
    <div class="container mx-auto p-5">
        <div class="flex flex-wrap justify-center">
            <div class="w-full lg:w-1/2 xl:w-1/3 p-6">
                @if (session('status'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
                        {{ session('status') }}
                    </div>
                @endif

                <div class="bg-white shadow-md rounded p-4 mt-3">
                    <div class="flex justify-between mb-4">
                        <h4 class="text-lg font-bold">Permissions</h4>
                        <a href="{{ url('permissions/create') }}" class="bg-blue-500 hover:bg-blue-700 text-black font-bold py-2 px-4 rounded float-right">Add Permission</a>
                    </div>
                    <div class="p-4">
                        <table class="w-full text-sm text-left text-gray-500">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                <tr>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($permissions as $permission)
                                <tr class="bg-white border-b">
                                    <td>{{ $permission->id }}</td>
                                    <td>{{ $permission->name }}</td>
                                    <td>
                                        @can('update permission')
                                            <a href="{{ url('permissions/'.$permission->id.'/edit') }}" class="bg-green-500 hover:bg-green-700 text-black font-bold py-2 px-4 rounded">Edit</a>
                                        @endcan

                                        @can('delete permission')
                                            <a href="{{ url('permissions/'.$permission->id.'/delete') }}" class="bg-red-500 hover:bg-red-700 text-black font-bold py-2 px-4 rounded">Delete</a>
                                        @endcan
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