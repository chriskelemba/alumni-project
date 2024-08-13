<x-app-layout>
    <div class="container mx-auto p-6">
        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <div class="p-6">
                <div class="flex justify-between mb-4">
                    <h4 class="text-lg font-bold">Job Feedbacks</h4>
                    <a href="{{ url('/dashboard') }}">
                        <x-danger-button>{{ __('Back') }}</x-danger-button>
                    </a>
                </div>
                <table class="w-full text-sm text-center text-gray-500">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                        <tr>
                            <th class="py-3 px-6">Job Title</th>
                            <th class="py-3 px-6">User Name</th>
                            <th class="py-3 px-6">Date Submitted</th>
                            <th class="py-3 px-6">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($feedbacks as $feedback)
                            <tr class="bg-white border-b">
                                <td class="py-4 px-6">{{ $feedback->job->title }}</td>
                                <td class="py-4 px-6">{{ $feedback->user->name }}</td>
                                <td class="py-4 px-6">{{ $feedback->created_at->format('d/m/Y') }}</td>
                                <td class="py-4 px-6">
                                    <a href="{{ route('feedback.show', $feedback->id) }}">
                                        <x-primary-button>{{ __('Details') }}</x-primary-button>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
