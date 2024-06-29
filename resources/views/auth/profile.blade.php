<x-guest-layout>
    <div class="container mx-auto p-5">
        <div class="flex flex-wrap justify-center">
            <div class="w-full p-6">
                <div class="flex justify-between mb-4">
                    <h4 class="text-lg font-bold">Activate Your Account</h4>
                </div>
                <div class="p-4">
                    @if (session('error'))
                        <p class="text-red-500">{{ session('error') }}</p>
                    @endif
                    <form method="POST" action="{{ route('save-profile') }}">
                        @csrf
                        <input type="hidden" name="token" value="{{ $token }}">
                    
                        {{-- <div>
                            <label for="name">Name:</label>
                            <input type="text" id="name" name="name" value="{{ old('name') }}">
                        </div>
                    
                        <div>
                            <label for="email">Email:</label>
                            <input type="email" id="email" name="email" value="{{ old('email') }}" readonly>
                        </div> --}}
                    
                        <div>
                            <label for="skills">Skills:</label>
                            <input type="text" id="skills" name="skills">
                        </div>
                    
                        <button type="submit">Save profile</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>