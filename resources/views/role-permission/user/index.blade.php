<x-app-layout>
    <div class="container mx-auto p-5">
        <div class="flex flex-wrap justify-center">
            <div class="w-full p-6">

                @if (session('status'))
                    <div class="bg-green-500 text-white font-bold rounded p-4 mb-4" role="alert">{{ session('status') }}</div>
                @endif

                <div class="bg-white shadow-md rounded p-4">
                    <div class="flex justify-between mb-4">
                        <div>
                            @role('employee')
                            <h4 class="text-lg font-bold">Users</h4>
                            @endrole
                            @role('super-admin|admin')
                            <span class="bg-gray-100 text-black-700 text-sm font-bold mr-2 px-2.5 py-0.5 uppercase rounded block">Click on the name to view user profile. Only works if user has profile.</span>
                            @endrole
                        </div>
                        <div class="flex justify-center">
                            @role('employee')
                            @if(request()->has('filter_skills'))
                                <a href="{{ url('users') }}" class="mx-2">
                                    <x-primary-button>{{ __('Show All Alumnis') }}</x-primary-button>
                                </a>
                            @else
                                <form action="{{ url('users') }}" method="GET" class="flex items-center mx-2">
                                    <input type="hidden" name="filter_skills" value="1">
                                    <x-primary-button>{{ __('Filter by My Skills') }}</x-primary-button>
                                </form>
                            @endif
                            @endrole
                            @role('super-admin|admin')
                            @can('delete user')
                            <a href="{{ url('users/trash') }}" class="mx-1">
                                <x-primary-button>{{ __('Recycling Bin') }}</x-primary-button>
                            </a>
                            @endcan
                            <a href="{{ url('users/create') }}">
                                <x-primary-button>{{ __('Add User') }}</x-primary-button>
                            </a>
                            @endrole
                        </div>
                    </div>

                    @role('super-admin|admin')
                    @php
                        [$alumniUsers, $otherUsers] = $users->partition(function ($user) {
                            return $user->hasRole('alumni');
                        });
                    @endphp

                    <!-- Alumni Users Section -->
                    <h2 class="text-lg font-bold mb-4">{{ __('Alumnis') }}</h2>
                    <div class="overflow-x-auto mb-8">
                        <table class="w-full text-sm text-center text-gray-500">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                <tr>
                                    <th class="py-3 px-6">Id</th>
                                    <th class="py-3 px-6">Name</th>
                                    <th class="py-3 px-6">Email</th>
                                    <th class="py-3 px-6">Roles</th>
                                    <th class="py-3 px-6">Skills</th>
                                    <th class="py-3 px-6">Status</th>
                                    @can('update user')
                                    <th class="py-3 px-6">Action</th>
                                    @endcan
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($alumniUsers as $user)
                                <tr class="bg-white border-b">
                                    <td class="py-4 px-6">{{ $user->id }}</td>
                                    <td class="py-4 px-6">
                                        @if($user->profile_setup == 1)
                                        <a href="{{ url('profile/'.$user->id) }}">
                                            {{ $user->name }}
                                        </a>
                                    @else
                                        {{ $user->name }}
                                    @endif
                                    </td>
                                    <td class="py-4 px-6">{{ $user->email }}</td>
                                    <td class="py-4 px-6">
                                        @foreach ($user->getRoleNames() as $rolename)
                                            <span class="bg-blue-100 text-blue-800 text-xs font-bold mr-2 px-2.5 py-0.5 rounded">{{ $rolename }}</span>
                                        @endforeach
                                    </td>
                                    <td class="py-4 px-6 text-center">
                                        @if($user->skills->count() > 0)
                                            @foreach($user->skills as $skill)
                                                <span class="bg-blue-100 text-blue-800 text-xs font-bold mr-2 px-2.5 py-0.5 rounded inline-block mb-1">{{ $skill->name }}</span>
                                            @endforeach
                                        @else
                                            {{ __("No Skills") }}
                                        @endif
                                    </td>
                                    <td class="py-4 px-6">
                                        @if ($user->active)
                                            <span class="bg-green-100 text-green-800 text-xs font-bold mr-2 px-2.5 py-0.5 rounded">{{ __('Activated') }}</span>
                                        @else
                                            <span class="bg-red-100 text-red-800 text-xs font-bold mr-2 px-2.5 py-0.5 rounded">{{ __('Deactivated') }}</span>
                                        @endif
                                    </td>
                                    @can('update user')
                                    <td class="py-4 px-6 text-center">
                                        <a href="{{ url('users/'.$user->id.'/edit') }}">
                                            <x-secondary-button>{{ __('Edit') }}</x-secondary-button>
                                        </a>
                                        @can('delete user')
                                        @if (!$user->active)
                                            <a href="{{ url('users/'.$user->id.'/delete') }}" onclick="return confirm('Are you sure you want to delete this user?')">
                                                <x-danger-button>{{ __('Delete') }}</x-danger-button>
                                            </a>
                                        @endif
                                        @endcan
                                        @can('deactivate user')
                                        @if ($user->active)
                                        <a href="{{ url('users/'.$user->id.'/deactivateAccount') }}" onclick="return confirm('Are you sure you want to deactivate this user?')">
                                            <x-danger-button>{{ __('Deactivate') }}</x-danger-button>
                                        </a>
                                        @endif
                                        @endcan
                                    </td>
                                    @endcan
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Other Users Section -->
                    <h2 class="text-lg font-bold mb-4">{{ __('Admins and Employees') }}</h2>
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-center text-gray-500">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                <tr>
                                    <th class="py-3 px-6">Id</th>
                                    <th class="py-3 px-6">Name</th>
                                    <th class="py-3 px-6">Email</th>
                                    <th class="py-3 px-6">Roles</th>
                                    <th class="py-3 px-6">Status</th>
                                    @can('update user')
                                    <th class="py-3 px-6">Action</th>
                                    @endcan
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($otherUsers as $user)
                                <tr class="bg-white border-b">
                                    <td class="py-4 px-6">{{ $user->id }}</td>
                                    <td class="py-4 px-6">{{ $user->name }}</td>
                                    <td class="py-4 px-6">{{ $user->email }}</td>
                                    <td class="py-4 px-6">
                                        @foreach ($user->getRoleNames() as $rolename)
                                            <span class="bg-blue-100 text-blue-800 text-xs font-bold mr-2 px-2.5 py-0.5 rounded">{{ $rolename }}</span>
                                        @endforeach
                                    </td>
                                    <td class="py-4 px-6">
                                        @if ($user->active)
                                            <span class="bg-green-100 text-green-800 text-xs font-bold mr-2 px-2.5 py-0.5 rounded">{{ __('Activated') }}</span>
                                        @else
                                            <span class="bg-red-100 text-red-800 text-xs font-bold mr-2 px-2.5 py-0.5 rounded">{{ __('Deactivated') }}</span>
                                        @endif
                                    </td>
                                    @can('update user')
                                    <td class="py-4 px-6 text-center">
                                        <a href="{{ url('users/'.$user->id.'/edit') }}">
                                            <x-secondary-button>{{ __('Edit') }}</x-secondary-button>
                                        </a>
                                        @can('delete user')
                                        @if (!$user->active)
                                            <a href="{{ url('users/'.$user->id.'/delete') }}" onclick="return confirm('Are you sure you want to delete this user?')">
                                                <x-danger-button>{{ __('Delete') }}</x-danger-button>
                                            </a>
                                        @endif
                                        @endcan
                                        @can('deactivate user')
                                        @if ($user->active)
                                        <a href="{{ url('users/'.$user->id.'/deactivateAccount') }}" onclick="return confirm('Are you sure you want to deactivate this user?')">
                                            <x-danger-button>{{ __('Deactivate') }}</x-danger-button>
                                        </a>
                                        @endif
                                        @endcan
                                    </td>
                                    @endcan
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endrole
                @role('employee')
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-center text-gray-500">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                            <tr>
                                <th class="py-3 px-6">Name</th>
                                <th class="py-3 px-6">Email</th>
                                <th class="py-3 px-6">Skills</th>
                                <th class="py-3 px-6">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($alumniUsers as $user)
                            <tr class="bg-white border-b">
                                <td class="py-4 px-6">{{ $user->name }}</td>
                                <td class="py-4 px-6">{{ $user->email }}</td>
                                <td class="py-4 px-6">
                                    @if($user->skills->count() > 0)
                                        <div class="flex flex-wrap justify-center">
                                            @foreach($user->skills as $skill)
                                                <span class="bg-blue-100 text-blue-800 text-xs font-bold mr-2 px-2.5 py-0.5 rounded">{{ $skill->name }}</span>
                                            @endforeach
                                        </div>
                                    @else
                                        {{ __("No Skills") }}
                                    @endif
                                </td>
                                <td class="py-4 px-6 text-center">
                                    @if($user->profile_setup == 1)
                                        <a href="{{ url('profile/'.$user->id) }}">
                                            <x-primary-button>{{ __('View Profile') }}</x-primary-button>
                                        </a>
                                    @else
                                        <span class="text-gray-500">{{ __("Alumni has not set profile up.") }}</span>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @endrole            
            </div>
        </div>
    </div>
</x-app-layout>
    