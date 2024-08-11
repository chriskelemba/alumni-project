<section>
    <div class="mt-10 mb-5">
        @if ($user->profile_picture)
            <img src="{{ Storage::url($user->profile_picture) }}" alt="Profile Picture" class="rounded-full h-64 w-64 object-cover">
        @else
            <img src="{{ asset('images/default-profile.png') }}" alt="Default Profile Picture" class="rounded-full h-64 w-64 object-cover">
        @endif
        <p class="my-3 text-2xl font-semibold">{{ $user->name }}</p>
        <p class="my-3">
            @if($user->skills->count() > 0)
            {{ __("Skills: ") }}
                @foreach($user->skills as $skill)
                    <span class="bg-blue-100 text-blue-800 text-xs font-bold mr-2 px-2.5 py-0.5 rounded">{{ $skill->name }}</span>
                @endforeach
            @else
                {{ __("") }}
            @endif
        </p>        
        <div class="flex py-1 items-center">
        @if ($user->phone_number || $user->location)
            <div class="flex py-1 items-center">
                <p class="text-blue-500 font-semibold mr-2">Contact Info:</p>
                
                @if ($user->phone_number)
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-telephone-fill mr-1 my-1" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M1.885.511a1.745 1.745 0 0 1 2.61.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.68.68 0 0 0 .178.643l2.457 2.457a.68.68 0 0 0 .644.178l2.189-.547a1.75 1.75 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.6 18.6 0 0 1-7.01-4.42 18.6 18.6 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877z"/>
                    </svg>
                    <p>{{ $user->phone_number }}</p>
                @endif
                
                @if ($user->phone_number || $user->location)
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-dot mx-1" viewBox="0 0 16 16">
                        <path d="M8 9.5a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3"/>
                    </svg>
                @endif
                
                @if ($user->location)
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-geo-alt-fill mr-1 my-1" viewBox="0 0 16 16">
                        <path d="M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10m0-7a3 3 0 1 1 0-6 3 3 0 0 1 0 6"/>
                    </svg>
                    <p>{{ $user->location }}</p>
                @endif
            </div>
        @endif        
        </div>
        @if(auth()->check() && auth()->user()->id !== $user->id)
        <div class="mt-3">
            <a href="{{ route('messages.send', $user->id) }}">
                <x-primary-button>{{ __('Message') }}</x-primary-button>
            </a>
        </div>
        @endif
        @if(auth()->check() && auth()->user()->id === $user->id)
        <div class="flex mt-3">
            <a href="{{ url('/messages') }}" class="mr-2">
                <x-primary-button>{{ __('View Messages') }}</x-primary-button>
            </a>
            <a href="{{ url('/profile') }}">
                <x-primary-button>{{ __('Edit Profile') }}</x-primary-button>
            </a>
        </div>
        @endif

        <div class="flex space-x-4 mt-4">
            @if ($socials && $socials->instagram)
                <a href="{{ $socials->instagram }}" target="_blank">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-instagram mr-1" viewBox="0 0 16 16">
                        <path d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.9 3.9 0 0 0-1.417.923A3.9 3.9 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.9 3.9 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.9 3.9 0 0 0-.923-1.417A3.9 3.9 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599s.453.546.598.92c.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.5 2.5 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.5 2.5 0 0 1-.92-.598 2.5 2.5 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233s.008-2.388.046-3.231c.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92s.546-.453.92-.598c.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92m-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217m0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334"/>
                    </svg>
                </a>
            @endif
            @if ($socials && $socials->youtube)
                <a href="{{ $socials->youtube }}" target="_blank">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-youtube mr-1" viewBox="0 0 16 16">
                        <path d="M8.051 1.999h.089c.822.003 4.987.033 6.11.335a2.01 2.01 0 0 1 1.415 1.42c.101.38.172.883.22 1.402l.01.104.022.26.008.104c.065.914.073 1.77.074 1.957v.075c-.001.194-.01 1.108-.082 2.06l-.008.105-.009.104c-.05.572-.124 1.14-.235 1.558a2.01 2.01 0 0 1-1.415 1.42c-1.16.312-5.569.334-6.18.335h-.142c-.309 0-1.587-.006-2.927-.052l-.17-.006-.087-.004-.171-.007-.171-.007c-1.11-.049-2.167-.128-2.654-.26a2.01 2.01 0 0 1-1.415-1.419c-.111-.417-.185-.986-.235-1.558L.09 9.82l-.008-.104A31 31 0 0 1 0 7.68v-.123c.002-.215.01-.958.064-1.778l.007-.103.003-.052.008-.104.022-.26.01-.104c.048-.519.119-1.023.22-1.402a2.01 2.01 0 0 1 1.415-1.42c.487-.13 1.544-.21 2.654-.26l.17-.007.172-.006.086-.003.171-.007A100 100 0 0 1 7.858 2zM6.4 5.209v4.818l4.157-2.408z"/>
                    </svg>
                </a>
            @endif
            @if ($socials && $socials->twitter)
                <a href="{{ $socials->twitter }}" target="_blank">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-twitter mr-1" viewBox="0 0 16 16">
                        <path d="M5.026 15c6.038 0 9.341-5.003 9.341-9.334q.002-.211-.006-.422A6.7 6.7 0 0 0 16 3.542a6.7 6.7 0 0 1-1.889.518 3.3 3.3 0 0 0 1.447-1.817 6.5 6.5 0 0 1-2.087.793A3.286 3.286 0 0 0 7.875 6.03a9.32 9.32 0 0 1-6.767-3.429 3.29 3.29 0 0 0 1.018 4.382A3.3 3.3 0 0 1 .64 6.575v.045a3.29 3.29 0 0 0 2.632 3.218 3.2 3.2 0 0 1-.865.115 3 3 0 0 1-.614-.057 3.28 3.28 0 0 0 3.067 2.277A6.6 6.6 0 0 1 .78 13.58a6 6 0 0 1-.78-.045A9.34 9.34 0 0 0 5.026 15"/>
                    </svg>
                </a>
            @endif
            @if ($socials && $socials->tiktok)
                <a href="{{ $socials->tiktok }}" target="_blank">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-tiktok mr-1" viewBox="0 0 16 16">
                        <path d="M9 0h1.98c.144.715.54 1.617 1.235 2.512C12.895 3.389 13.797 4 15 4v2c-1.753 0-3.07-.814-4-1.829V11a5 5 0 1 1-5-5v2a3 3 0 1 0 3 3z"/>
                    </svg>
                </a>
            @endif
            @if ($socials && $socials->linkedin)
                <a href="{{ $socials->linkedin }}" target="_blank">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-linkedin mr-1" viewBox="0 0 16 16">
                        <path d="M0 1.146C0 .513.526 0 1.175 0h13.65C15.474 0 16 .513 16 1.146v13.708c0 .633-.526 1.146-1.175 1.146H1.175C.526 16 0 15.487 0 14.854zm4.943 12.248V6.169H2.542v7.225zm-1.2-8.212c.837 0 1.358-.554 1.358-1.248-.015-.709-.52-1.248-1.342-1.248S2.4 3.226 2.4 3.934c0 .694.521 1.248 1.327 1.248zm4.908 8.212V9.359c0-.216.016-.432.08-.586.173-.431.568-.878 1.232-.878.869 0 1.216.662 1.216 1.634v3.865h2.401V9.25c0-2.22-1.184-3.252-2.764-3.252-1.274 0-1.845.7-2.165 1.193v.025h-.016l.016-.025V6.169h-2.4c.03.678 0 7.225 0 7.225z"/>
                    </svg>
                </a>
            @endif
        </div>
    </div>
</section>
