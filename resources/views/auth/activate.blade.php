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
                    <form method="POST" action="{{ route('set-password', $token) }}">
                        @csrf
                            
                        <div class="mb-4">
                            <label for="password" class="block mb-2 text-sm font-bold">Password</label>
                            <input id="password" type="password" name="password" required class="w-full p-2 pl-10 text-sm text-gray-700"/>
                        </div>
                        <div class="mb-4">
                            <label for="password_confirmation" class="block mb-2 text-sm font-bold">Confirm Password</label>
                            <input id="password_confirmation" type="password" name="password_confirmation" required class="w-full p-2 pl-10 text-sm text-gray-700"/>
                        </div>
                        <div class="mb-4">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Set Password</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>