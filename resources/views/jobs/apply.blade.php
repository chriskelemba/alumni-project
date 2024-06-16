<x-app-layout>
    <div class="container mx-auto p-5">
        <div class="flex flex-wrap justify-center">
            <div class="w-full p-6">
                <div class="bg-white shadow-md rounded p-4">
                    <div class="flex justify-between mb-4">
                        <h4 class="text-lg font-bold">Apply for {{ $job->title }}</h4>
                        <a href="{{ url('jobs') }}" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Back</a>
                    </div>
                    <form method="POST" action="{{ url('jobs/'.$job->id) }}">
                        @csrf
                        <div class="mb-4">
                            <label for="name" class="block text-sm font-bold mb-2">Name</label>
                            <input type="text" id="name" name="name" class="w-full p-2 pl-10 text-sm text-gray-700" required>
                        </div>
                        <div class="mb-4">
                            <label for="email" class="block text-sm font-bold mb-2">Email</label>
                            <input type="email" id="email" name="email" class="w-full p-2 pl-10 text-sm text-gray-700" required>
                        </div>
                        <div class="mb-4">
                            <label for="resume" class="block text-sm font-bold mb-2">Resume (PDF or DOCX)</label>
                            <input type="file" id="resume" name="resume" class="w-full p-2 pl-10 text-sm text-gray-700" required>
                        </div>
                        <div class="mb-4">
                            <label for="cover_letter" class="block text-sm font-bold mb-2">Cover Letter</label>
                            <textarea id="cover_letter" name="cover_letter" class="w-full p-2 pl-10 text-sm text-gray-700" required></textarea>
                        </div>
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Apply</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>