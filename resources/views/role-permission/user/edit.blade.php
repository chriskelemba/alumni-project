<x-app-layout>
    <div class="container mx-auto p-5">
        <div class="flex flex-wrap justify-center">
            <div class="w-full p-6">
                <div class="bg-white shadow-md rounded p-4">
                    <div class="flex justify-between mb-4">
                        <h4 class="text-lg font-bold">Edit User</h4>
                        <a href="{{ url('users') }}" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Back</a>
                    </div>
                    <div class="p-4">
                        <form action="{{ url('users/'.$user->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="mb-4">
                                <label for="" class="block mb-2 text-sm font-bold">Name</label>
                                <input type="text" name="name" value="{{ $user->name }}" class="w-full p-2 pl-10 text-sm text-gray-700"/>

                                @error('name')
                                    <span class="text-xs text-red-600">{{ $message }}</span>
                                @enderror

                            </div>
                            <div class="mb-4">
                                <label for="" class="block mb-2 text-sm font-bold">Email</label>
                                <input type="email" name="email" value="{{ $user->email }}" class="w-full p-2 pl-10 text-sm text-gray-700"/>
                            </div>
                            <div class="mb-4">
                                <label for="" class="block mb-2 text-sm font-bold">Password</label>
                                <input type="password" name="password" class="w-full p-2 pl-10 text-sm text-gray-700"/>
                                
                                @error('password')
                                    <span class="text-xs text-red-600">{{ $message }}</span>
                                @enderror
                                
                            </div>
                            <div class="mb-4">
                                <label for="" class="block mb-2 text-sm font-bold">Roles</label>
                                <select name="roles[]" class="w-full p-2 pl-10 text-sm text-gray-700">
                                    <option value="">Select Role</option>

                                    @foreach ($roles as $role)
                                        <option
                                        value="{{ $role }}"
                                        {{ in_array($role, $userRoles) ? 'selected':'' }}
                                        >
                                        {{ $role }}
                                    </option>
                                    @endforeach

                                </select>
                                
                                @error('role')
                                    <span class="text-xs text-red-600">{{ $message }}</span>
                                @enderror
                                
                            </div>
                            {{-- <div>
                                <label for="skills">Select skills:</label>
                                <select name="skills[]" id="skills" multiple>
                                    @foreach($skills as $skill)
                                        <option value="{{ $skill }}" 
                                                @if(in_array($skill, $userSkills)) selected @endif
                                        >
                                            {{ $skill }}
                                        </option>
                                    @endforeach
                                </select>
                            </div> --}}
                            @foreach ($skills as $key => $skill)
                            <div class="w-1/2 md:w-1/3 xl:w-1/4 p-2">
                                <label>
                                    <input type="checkbox"
                                    name="skills[]"
                                    value="{{ $key }}"
                                    {{ in_array($skill, $userSkills)? 'checked':'' }}
                                    />
                                    {{ $skill }}
                                </label>
                            </div>
                            @endforeach
                            <div class="mb-4">
                                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>