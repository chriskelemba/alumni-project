<x-app-layout>
    <div class="container mx-auto p-5">
        <div class="flex flex-wrap justify-center">
            <div class="w-full p-6">

                @if (session('status'))
                    <div class="bg-green-500 text-white font-bold rounded p-4 mb-4" role="alert">{{ session('status') }}</div>
                @endif

                <div class="bg-white shadow-md rounded p-4">
                    <div class="flex justify-between mb-4">
                        <h4 class="text-lg font-bold">Users</h4>
                        <div>
                            @can('delete user')
                            <a href="{{ url('users/trash') }}">
                                <x-primary-button>{{ __('Recycling Bin') }}</x-primary-button>
                            </a>
                            <a href="{{ url('skills') }}">
                                <x-primary-button>{{ __('Skills') }}</x-primary-button>
                            </a>
                            @endcan
                            <a href="{{ url('users/create') }}">
                                <x-primary-button>{{ __('Add User') }}</x-primary-button>
                            </a>
                        </div>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-center text-gray-500">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                <tr>
                                    <th class="py-3 px-6">Id</th>
                                    <th class="py-3 px-6">Name</th>
                                    <th class="py-3 px-6">Email</th>
                                    <th class="py-3 px-6">Roles</th>
                                    @can('update user')
                                    <th class="py-3 px-6">Action</th>
                                    @endcan
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                <tr class="bg-white border-b">
                                    <td class="py-4 px-6">{{ $user->id }}</td>
                                    <td class="py-4 px-6">{{ $user->name }}</td>
                                    <td class="py-4 px-6">{{ $user->email }}</td>
                                    <td class="py-4 px-6">
                                        @if (!empty($user->getRoleNames()))
                                            @foreach ($user->getRoleNames() as $rolename)
                                                <span class="bg-blue-100 text-blue-800 text-xs font-bold mr-2 px-2.5 py-0.5 rounded">{{ $rolename }}</span>
                                            @endforeach
                                        @endif
                                    </td>
                                    @can('update user')
                                    <td class="py-4 px-6">
                                        @can('update user')
                                            <a href="{{ url('users/'.$user->id.'/edit') }}">
                                                <x-secondary-button>{{ __('Edit') }}</x-secondary-button>
                                            </a>
                                        @endcan

                                        @can('delete user')
                                            <a href="{{ url('users/'.$user->id.'/delete') }}" onclick="return confirm('Are you sure you want to delete this user?')">
                                                <x-danger-button>{{ __('Delete') }}</x-danger-button>
                                            </a>
                                        @endcan
                                    </td>
                                    @endcan
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>