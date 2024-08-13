<x-profile-layout>
    @if (session('status'))
        <div class="bg-green-500 text-white font-bold rounded p-4 mb-6" role="alert">
            {{ session('status') }}
        </div>
    @endif

    <div class="flex flex-col items-center mt-6">
        <form action="{{ route('saveConfirm-project') }}" method="POST" class="w-full max-w-md mb-6">
            @csrf
            <h1 class="font-bold text-xl mb-5 text-center">Do you want to post a project?</h1>
            <div class="flex justify-center">
                <x-primary-button>
                    {{ __('Post Project') }}
                </x-primary-button>
            </div>
        </form>

        <form method="GET" action="{{ route('social') }}" class="w-full max-w-md mb-6">
            @csrf
            <div class="flex justify-center">
                <x-primary-button>
                    {{ __('Skip') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</x-profile-layout>
