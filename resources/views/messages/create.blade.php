<x-app-layout>
    <div class="container mx-auto p-5">
        <div class="flex flex-wrap justify-center">
            <div class="w-full p-6">
                <div class="bg-white shadow-md rounded p-4">
                    <div class="flex justify-between mb-4">
                        <h4 class="text-lg font-bold">Send Message</h4>
                        <a href="{{ url('profile/'.$user->id) }}">
                            <x-danger-button>{{ __('Back') }}</x-danger-button>
                        </a>
                    </div>
                    <div class="p-4">
                        <form action="{{ route('messages.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="receiver_id" value="{{ $user->id }}">
                            
                            <div class="mb-4">
                                <x-input-label for="message" :value="__('Message')" />
                                <textarea id="message" name="message" rows="4" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full" required></textarea>
                            </div>
                            
                            <div class="mb-4 mt-6">
                                <x-primary-button>
                                    {{ __('Send Message') }}
                                </x-primary-button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
