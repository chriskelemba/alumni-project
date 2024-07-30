<x-profile-layout>
    @if (session('status'))
    <div class="bg-green-500 text-white font-bold rounded p-4 mb-4" role="alert">{{ session('status') }}</div>
@endif
                        <form action="{{ route('save-portfolio') }}" method="POST">
                            @csrf

                            <h1 class="font-bold text-xl mb-5">Create your Portfolio</h1>
                            <div class="mb-4">
                                <x-input-label for="title" :value="__('Title')" />
                                <x-text-input id="title" class="block mt-1 w-full" type="text" name="title" />
                            </div>
                            <div class="mb-4">
                                <x-input-label for="description" :value="__('Description')" />
                                <textarea id="description" name="description" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full"></textarea>
                            </div>
                            <div class="mb-4">
                                <x-input-label for="skills" :value="__('Skills')" />
                                <textarea id="skills" name="skills" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full"></textarea>
                            </div>
                            <div class="mb-4">
                                <x-input-label for="achievements" :value="__('Achievements')" />
                                <textarea id="achievements" name="achievements" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full"></textarea>
                            </div>
                            <div class="mb-4">
                                <x-input-label for="work_experience" :value="__('Work Experience')" />
                                <textarea id="work_experience" name="work_experience" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full"></textarea>
                            </div>
                            <div class="mb-4">
                                <x-input-label for="education" :value="__('Education')" />
                                <textarea id="education" name="education" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full"></textarea>
                            </div>
                            <div class="flex items-center justify-end mt-6">
                                <x-primary-button>
                                    {{ __('Create Portfolio') }}
                                </x-primary-button>
                            </div>
                        </form>
                        <form method="POST" action="{{ route('logout') }}" class="flex items-center justify-end mt-4">
                            @csrf
                            <x-primary-button>
                                {{ __('Logout') }}
                            </x-primary-button>
                        </form>
</x-profile-layout>
