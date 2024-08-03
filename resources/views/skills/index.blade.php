<x-app-layout>
    <div class="container mx-auto p-5">
        <div class="flex flex-wrap justify-center">
            <div class="w-full p-6">

                @if (session('status'))
                    <div class="bg-green-500 text-white font-bold py-2 px-4 rounded mb-4">{{ session('status') }}</div>
                @endif

                <div class="bg-white shadow-md rounded p-4">
                    <div class="flex justify-between mb-4">
                        <h4 class="text-lg font-bold">Skills</h4>
                        <div>
                            <a href="{{ url('skills/trash') }}">
                                <x-primary-button>{{ __('Recycling Bin') }}</x-primary-button>
                            </a>
                            <a href="{{ url('skills/create') }}">
                                <x-primary-button>{{ __('Add Skill') }}</x-primary-button>
                            </a>
                            <a href="{{ url('/') }}">
                                <x-danger-button>{{ __('Back') }}</x-danger-button>
                            </a>
                        </div>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-center text-gray-500">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                <tr>
                                    <th class="py-3 px-6">Id</th>
                                    <th class="py-3 px-6 w-50">Name</th>
                                    <th class="py-3 px-6">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($skills as $skill)
                                <tr class="bg-white border-b">
                                    <td class="py-4 px-6">{{ $skill->id }}</td>
                                    <td class="py-4 px-6">{{ $skill->name }}</td>
                                    <td class="py-4 px-6">
                                        <a href="{{ url('skills/'.$skill->id.'/edit') }}">
                                            <x-secondary-button>{{ __('Edit') }}</x-secondary-button>
                                        </a>
                                        <a href="{{ url('skills/'.$skill->id.'/delete') }}" onclick="return confirm('Are you sure you want to delete this skill?')">
                                            <x-danger-button>{{ __('Delete') }}</x-danger-button>
                                        </a>
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
