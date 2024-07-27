<section>
    <header class="flex justify-between">
        <div>
            <h2 class="text-lg font-medium text-gray-900">
                {{ __('Profile Information') }}
            </h2>
            <p class="mt-1 text-sm text-gray-600">
                {{ __("User account details.") }}
            </p>
        </div>

        <div>
            @role('super-admin|admin|employee')
            <a href="{{ url('/users') }}">
                <x-danger-button>{{ __('Back') }}</x-danger-button>
            </a>
            @endrole
        </div>
    </header>
    
    <div class="mt-10 mb-5">
        @if ($user->profile_picture)
            <img src="{{ Storage::url($user->profile_picture) }}" alt="Profile Picture" class="rounded-full h-20 w-20 object-cover">
        @else
            <img src="{{ asset('images/default-profile.png') }}" alt="Default Profile Picture" class="rounded-full h-20 w-20 object-cover">
        @endif
        <p class="my-2">{{ $user->name }}</p>
        <p class="my-2">{{ ("Role: ") }}<b>{{ $user->roles->first()->name }}</b>{{ (".") }}</p>
        <p class="my-2">
            {{ __("Skills: ") }}
            @if($user->skills->count() > 0)
                @foreach($user->skills as $skill)
                    <b>{{ $skill->name }}</b>{{ $loop->last ? '.' : ', ' }}
                @endforeach
            @else
                {{ __("No skills added.") }}
            @endif
        </p>
        <a href="{{ url('/project') }}">
            <x-primary-button>{{ __('View Portfolio') }}</x-primary-button>
        </a>
    </div>
</section>
