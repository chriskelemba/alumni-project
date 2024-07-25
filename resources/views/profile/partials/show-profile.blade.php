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

        <a href="{{ url('/project') }}">
            <x-primary-button>{{ __('My Portfolio') }}</x-primary-button>
        </a>
    </header>
    
    <div class="mt-10 mb-5">
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
    </div>
</section>
