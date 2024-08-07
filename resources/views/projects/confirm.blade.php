<x-profile-layout>
    @if (session('status'))
        <div class="bg-green-500 text-white font-bold rounded p-4 mb-4" role="alert">{{ session('status') }}</div>
    @endif

    <form action="{{ route('saveConfirm-project') }}" method="POST" class="mb-4 mt-6">
        @csrf
        <h1 class="font-bold text-xl mb-5">Do you want to post a project?</h1>
        <div>
            <x-primary-button>
                {{ __('Post Project') }}
            </x-primary-button>
        </div>
    </form>

    <form method="GET" action="{{ route('social') }}">
        @csrf
        <x-primary-button>
            {{ __('Skip') }}
        </x-primary-button>
    </form>

    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <x-primary-button class="mb-4 mt-6">
            {{ __('Logout') }}
        </x-primary-button>
    </form>
</x-profile-layout>
