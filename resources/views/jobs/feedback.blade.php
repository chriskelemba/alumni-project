<x-app-layout>
    <div class="container mx-auto p-5">
        <div class="flex flex-wrap justify-center">
            <div class="w-full p-6">
                <div class="bg-white shadow-md rounded py-16 px-40">
                    <div class="mb-8 flex justify-center">
                        <a href="{{ url('jobs/'.$job->id.'/show')}}">
                            <x-danger-button>{{ __('Back') }}</x-danger-button>
                        </a>
                    </div>
                    <form action="{{ url('jobs/'.$job->id.'/submit-feedback') }}" method="POST" class="text-center">
                        @csrf
                        <div class="form-group">
                            <label for="feedback_text">Your Feedback:</label>
                            <textarea class="form-control" id="feedback_text" name="feedback_text" rows="3" required></textarea>
                        </div>
                        <x-primary-button>Submit</x-primary-button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>