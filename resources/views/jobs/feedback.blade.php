<x-app-layout>
    <div class="container mx-auto p-5">
        <div class="flex flex-wrap justify-center">
            <div class="w-full p-6">
                <div class="bg-white shadow-md rounded py-16 px-40">
                    <div class="mb-8 flex justify-center">
                        <x-danger-button class="bg-white hover:bg-white text-white py-2 px-4" disabled>Back</x-danger-button>
                        <h1 class="text-gray-800 text-2xl flex-1 text-center font-bold">{{ 'Feedback for: '.$job->title }}</h1>
                        <a href="{{ url('jobs/'.$job->id.'/show')}}">
                            <x-danger-button>{{ __('Back') }}</x-danger-button>
                        </a>
                    </div> 
                    <form action="{{ url('jobs/'.$job->id.'/submit-feedback') }}" method="POST" class="text-center">
                        @csrf
                        <div class="form-group">
                            <x-input-label for="feedback_text" :value="__('Your Feedback:')" />
                            <textarea class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full" id="feedback_text" name="feedback_text" rows="3" required></textarea>
                        </div>
                        <div class="my-6">
                            <x-primary-button>Submit</x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>