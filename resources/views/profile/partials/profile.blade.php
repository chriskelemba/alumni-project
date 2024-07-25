<section>
    <header class="flex justify-between">
        <div>
            <h2 class="text-lg font-medium text-gray-900">
                {{ __('Profile Information') }}
            </h2>
            <p class="mt-1 text-sm text-gray-600">
                {{ __("Your account details.") }}
            </p>
        </div>

        <a href="{{ url('/project') }}">
            <x-primary-button>{{ __('My Portfolio') }}</x-primary-button>
        </a>
    </header>
    
    <div class="mt-10 mb-5">
        @if ($user->profile_picture)
            <img src="{{ Storage::url($user->profile_picture) }}" alt="Profile Picture" class="rounded-full h-20 w-20 object-cover">
        @else
            <img src="{{ asset('images/default-profile.png') }}" alt="Default Profile Picture" class="rounded-full h-20 w-20 object-cover">
        @endif
        <p class="my-2">{{ auth()->user()->name }}</p>
        <p class="my-2">{{ ("Role: ") }}<b>{{ auth()->user()->roles->first()->name }}</b>{{ (".") }}</p>
        <p class="my-2">
            {{ __("Skills: ") }}
            @if(auth()->user()->skills->count() > 0)
                @foreach(auth()->user()->skills as $skill)
                    <b>{{ $skill->name }}</b>{{ $loop->last ? '.' : ', ' }}
                @endforeach
            @else
                {{ __("No skills added.") }}
            @endif
        </p>
    </div>

</section>
