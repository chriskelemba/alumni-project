<section>
    <header class="flex justify-between">
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('About') }}
        </h2>
    
        @if(auth()->user()->id === $user->id)
            <a href="{{ url('portfolio/'.$portfolio->id.'/edit') }}">
                <x-primary-button>{{ __('Edit Portfolio') }}</x-primary-button>
            </a>
        @endif
    </header>
    
    <div class="mt-10 mb-5">
        <p class="text-gray-600">{{ $portfolio->description }}</p>

        <div class="mt-4">
            <h4 class="text-xl font-semibold">Skills</h4>
            <p class="text-gray-600">{{ $portfolio->skills }}</p>
        </div>

        <div class="mt-4">
            <h4 class="text-xl font-semibold">Achievements</h4>
            <p class="text-gray-600">{{ $portfolio->achievements }}</p>
        </div>

        <div class="mt-4">
            <h4 class="text-xl font-semibold">Work Experience</h4>
            <p class="text-gray-600">{{ $portfolio->work_experience }}</p>
        </div>

        <div class="mt-4">
            <h4 class="text-xl font-semibold">Education</h4>
            <p class="text-gray-600">{{ $portfolio->education }}</p>
        </div>
    </div>
</section>
