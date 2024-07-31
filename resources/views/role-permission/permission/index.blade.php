<x-app-layout>
    <div class="container mx-auto p-5">
        <div class="flex flex-wrap justify-center">
            <div class="w-full p-6">
                @if (session('status'))
                    <div class="bg-green-500 text-white font-bold py-2 px-4 rounded mb-4">{{ session('status') }}</div>
                @endif

                <div class="bg-white shadow-md rounded p-4">
                    <div class="flex justify-between mb-4">
                        <h4 class="text-lg font-bold"></h4>
                        <a href="{{ url('permissions/create') }}">
                            <x-primary-button>{{ __('Add Permission') }}</x-primary-button>
                        </a>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-center text-gray-500">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                <tr>
                                    <th class="py-3 px-6">Id</th>
                                    <th class="py-3 px-6">Name</th>
                                    @can('update permission')
                                    <th class="py-3 px-6">Action</th>
                                    @endcan
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($permissions as $permission)
                                <tr class="bg-white border-b">
                                    <td class="py-4 px-6">{{ $permission->id }}</td>
                                    <td class="py-4 px-6">{{ $permission->name }}</td>
                                    @can('update permission')
                                    <td class="py-4 px-6">
                                        @can('update permission')
                                            <a href="{{ url('permissions/'.$permission->id.'/edit') }}">
                                                <x-secondary-button>{{ __('Edit') }}</x-secondary-button>
                                            </a>
                                        @endcan

                                        @can('delete permission')
                                            <a href="{{ url('permissions/'.$permission->id.'/delete') }}" onclick="return confirm('Are you sure you want to delete this permission?')">
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
    </div>
</x-app-layout>
