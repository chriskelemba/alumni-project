<x-app-layout>
    <div class="container mx-auto p-6">
        <div class="bg-white shadow-md rounded p-4">
            <h2 class="text-xl font-bold mb-4">Messages</h2>

            @if($senders->isEmpty())
                <p>{{ __('You have no messages.') }}</p>
            @else
                <ul>
                    @foreach($senders as $sender)
                        <li class="mb-4">
                            <div class="flex items-center">
                                <div class="mr-4">
                                    @if ($sender->profile_picture)
                                        <img src="{{ Storage::url($sender->profile_picture) }}" alt="{{ $sender->name }}" class="w-12 h-12 rounded-full">
                                    @else
                                        <img src="{{ asset('images/default-profile.png') }}" alt="{{ $sender->name }}" class="w-12 h-12 rounded-full">
                                    @endif
                                </div>
                                <div class="flex-grow">
                                    <h3 class="text-lg font-semibold">{{ $sender->name }}</h3>
                                    <a href="{{ url('/messages/'.$sender->id) }}">
                                        <x-primary-button>{{ __('Open Chat') }}</x-primary-button>
                                    </a>
                                </div>
                                <form action="{{ route('messages.destroy', $sender->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this chat?');">
                                    @csrf
                                    @method('DELETE')
                                    <x-danger-button type="submit">{{ __('Delete Chat') }}</x-danger-button>
                                </form>
                            </div>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>
</x-app-layout>
