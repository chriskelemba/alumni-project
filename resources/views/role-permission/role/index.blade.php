<x-app-layout>
    <div class="container mx-auto p-5">
        <div class="flex flex-wrap justify-center">
            <div class="w-full lg:w-1/2 xl:w-1/3 p-6">
                @if (session('status'))
                    <div class="bg-green-500 text-black font-bold py-2 px-4 rounded mb-4">{{ session('status') }}</div>
                @endif

                <div class="bg-white shadow-md rounded p-4 mt-3">
                    <div class="flex justify-between mb-4">
                        <h4 class="text-lg font-bold">Roles</h4>
                        <a href="{{ url('roles/create') }}" class="bg-blue-500 hover:bg-blue-700 text-black font-bold py-2 px-4 rounded">Add Role</a>
                    </div>
                    <div class="p-4">
                        <table class="w-full text-sm text-gray-700">
                            <thead>
                                <tr>
                                    <th class="px-4 py-2">Id</th>
                                    <th class="px-4 py-2 w-50">Name</th>
                                    <th class="px-4 py-2">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($roles as $role)
                                <tr>
                                    <td class="px-4 py-2">{{ $role->id }}</td>
                                    <td class="px-4 py-2">{{ $role->name }}</td>
                                    <td class="px-4 py-2">
                                        <a href="{{ url('roles/'.$role->id.'/give-permissions') }}" class="bg-orange-500 hover:bg-orange-700 text-orange-300 font-bold py-2 px-4 rounded">Add / Edit Role Permission</a>

                                        @can('update role')
                                            <a href="{{ url('roles/'.$role->id.'/edit') }}" class="bg-green-500 hover:bg-green-700 text-green font-bold py-2 px-4 rounded">Edit</a>
                                        @endcan

                                        @can('delete role')
                                            <a href="{{ url('roles/'.$role->id.'/delete') }}" class="bg-red-500 hover:bg-red-700 text-red font-bold py-2 px-4 rounded">Delete</a>
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