<x-app-layout>
    <div class="container mx-auto p-5">
        <div class="flex flex-wrap justify-center">
            <div class="w-full p-6">
                <div class="bg-white shadow-md rounded p-4">
                    <div class="flex justify-between mb-4">
                        <h4 class="text-lg font-bold">Create Skill</h4>
                        <a href="{{ url('users') }}" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Back</a>
                    </div>
                    <h1>Skills</h1>

                    <!-- Display existing skills -->
                    <ul>
                        @foreach($skills as $skill)
                            <li>{{ $skill->name }}</li>
                        @endforeach
                    </ul>
                    
                    <!-- Create new skill form -->
                    <form action="{{ route('skills.store') }}" method="POST">
                        @csrf
                        <label for="name">New Skill:</label>
                        <input type="text" id="name" name="name" required>
                        <button type="submit">Create Skill</button>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>