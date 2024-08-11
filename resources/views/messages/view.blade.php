<x-app-layout>
    <div class="container mx-auto p-6">
        <div class="bg-white shadow-md rounded p-4">
            <div class="flex justify-between">
                <h2 class="text-xl font-bold mb-4">Messages with {{ $user->name }}</h2>
                <a href="{{ url('messages') }}">
                    <x-danger-button>{{ __('Back') }}</x-danger-button>
                </a>
            </div>

            <div class="overflow-y-auto max-h-96">
                @forelse($messages as $message)
                    <div class="mb-4 {{ $message->sender_id == auth()->id() ? 'text-right' : '' }}">
                        <div class="flex items-center {{ $message->sender_id == auth()->id() ? 'justify-end' : 'justify-start' }}">
                            @if($message->sender_id != auth()->id())
                                <div class="mr-4">
                                    <img src="{{ $user->profile_picture ? Storage::url($user->profile_picture) : asset('images/default-profile.png') }}" alt="{{ $user->name }}" class="w-8 h-8 rounded-full">
                                </div>
                            @endif
                            <div class="bg-gray-100 p-3 rounded-lg {{ $message->sender_id == auth()->id() ? 'bg-blue-500 text-gray-700' : '' }}">
                                {{ $message->message }}
                            </div>
                            @if($message->sender_id == auth()->id())
                                <div class="ml-4">
                                    <img src="{{ auth()->user()->profile_picture ? Storage::url(auth()->user()->profile_picture) : asset('images/default-profile.png') }}" alt="{{ auth()->user()->name }}" class="w-8 h-8 rounded-full">
                                </div>
                            @endif
                        </div>
                    </div>
                @empty
                    <p>{{ __('No messages found.') }}</p>
                @endforelse
            </div>

            <form action="{{ route('messages.store') }}" method="POST" class="mt-4">
                @csrf
                <input type="hidden" name="receiver_id" value="{{ $user->id }}">
                <div class="mb-4">
                    <label for="message" class="block text-sm font-medium text-gray-700">Your Message</label>
                    <textarea id="message" name="message" rows="4" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full" required></textarea>
                </div>
                <x-primary-button>Send Message</x-primary-button>
            </form>
        </div>
    </div>
</x-app-layout>
