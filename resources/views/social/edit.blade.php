<x-app-layout>
    @if ($errors->any())
        <div class="bg-red-500 text-white font-bold rounded p-4 mb-4">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="container mx-auto p-5">
        <div class="flex flex-wrap justify-center">
            <div class="w-full p-6">
                <div class="bg-white shadow-md rounded p-4">
                    <div class="flex justify-between mb-4">
                        <h4 class="text-lg font-bold">Edit Social Media Links</h4>
                        <a href="{{ url('profile') }}">
                            <x-danger-button>{{ __('Back') }}</x-danger-button>
                        </a>
                    </div>
                    <div class="p-4">
                        <form action="{{ route('social.update') }}" method="POST">
                            @csrf

                            <div class="mb-4">
                                <div class="flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-instagram mr-2" viewBox="0 0 16 16">
                                        <path d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.9 3.9 0 0 0-1.417.923A3.9 3.9 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.9 3.9 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.9 3.9 0 0 0-.923-1.417A3.9 3.9 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599s.453.546.598.92c.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.5 2.5 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.5 2.5 0 0 1-.92-.598 2.5 2.5 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233s.008-2.388.046-3.231c.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92s.546-.453.92-.598c.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92m-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217m0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334"/>
                                    </svg>
                                    <x-input-label for="instagram" :value="__('Instagram')" />
                                </div>
                                <x-text-input id="instagram" class="block mt-1 w-full" type="text" name="instagram" value="{{ old('instagram', $socials->instagram) }}" />
                                <x-input-error :messages="$errors->get('instagram')" class="mt-2" />
                            </div>
                            
                            <div class="mb-4">
                                <div class="flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-youtube mr-2" viewBox="0 0 16 16">
                                        <path d="M8.051 1.999h.089c.822.003 4.987.033 6.11.335a2.01 2.01 0 0 1 1.415 1.42c.101.38.172.883.22 1.402l.01.104.022.26.008.104c.065.914.073 1.77.074 1.957v.075c-.001.194-.01 1.108-.082 2.06l-.008.105-.009.104c-.05.572-.124 1.14-.235 1.558a2.01 2.01 0 0 1-1.415 1.42c-1.16.312-5.569.334-6.18.335h-.142c-.309 0-1.587-.006-2.927-.052l-.17-.006-.087-.004-.171-.007-.171-.007c-1.11-.049-2.167-.128-2.654-.26a2.01 2.01 0 0 1-1.415-1.419c-.111-.417-.185-.986-.235-1.558L.09 9.82l-.008-.104A31 31 0 0 1 0 7.68v-.123c.002-.215.01-.958.064-1.778l.007-.103.003-.052.008-.104.022-.26.01-.104c.048-.519.119-1.023.22-1.402a2.01 2.01 0 0 1 1.415-1.42c.487-.13 1.544-.21 2.654-.26l.17-.007.172-.006.086-.003.171-.007A100 100 0 0 1 7.858 2zM6.4 5.209v4.818l4.157-2.408z"/>
                                    </svg>
                                    <x-input-label for="youtube" :value="__('YouTube')" />
                                </div>
                                <x-text-input id="youtube" class="block mt-1 w-full" type="text" name="youtube" value="{{ old('youtube', $socials->youtube) }}" />
                                <x-input-error :messages="$errors->get('youtube')" class="mt-2" />
                            </div>
                            
                            <div class="mb-4">
                                <div class="flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-twitter mr-2" viewBox="0 0 16 16">
                                        <path d="M5.026 15c6.03 0 9.333-5 9.333-9.333v-.425a6.66 6.66 0 0 0 1.623-1.683A6.83 6.83 0 0 1 15 4.098a6.59 6.59 0 0 0 1.93-1.762 6.832 6.832 0 0 1-1.79.491A3.293 3.293 0 0 0 14.611.5c-1.63 0-2.952 1.35-2.952 3.013 0 .236.026.468.076.686a9.389 9.389 0 0 1-6.828-3.482A3.107 3.107 0 0 0 3.66 4.735a3.004 3.004 0 0 0 1.39-.383c-.724-.012-1.379-.213-1.975-.53a3.013 3.013 0 0 0-.423 1.596c0 1.11.565 2.087 1.417 2.664a2.989 2.989 0 0 1-1.377-.377v.038c0 1.563 1.107 2.87 2.572 3.166a3.046 3.046 0 0 1-1.371.052c.389 1.189 1.514 2.057 2.856 2.081a6.623 6.623 0 0 1-4.096 1.406"/>
                                    </svg>
                                    <x-input-label for="twitter" :value="__('Twitter')" />
                                </div>
                                <x-text-input id="twitter" class="block mt-1 w-full" type="text" name="twitter" value="{{ old('twitter', $socials->twitter) }}" />
                                <x-input-error :messages="$errors->get('twitter')" class="mt-2" />
                            </div>

                            <div class="mb-4">
                                <div class="flex">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-tiktok mr-1" viewBox="0 0 16 16">
                                        <path d="M9 0h1.98c.144.715.54 1.617 1.235 2.512C12.895 3.389 13.797 4 15 4v2c-1.753 0-3.07-.814-4-1.829V11a5 5 0 1 1-5-5v2a3 3 0 1 0 3 3z"/>
                                    </svg>
                                    <x-input-label for="tiktok" :value="__('TikTok')" />
                                </div>
                                <x-text-input id="tiktok" class="block mt-1 w-full" type="text" name="tiktok" value="{{ old('tiktok', $socials->tiktok) }}" />
                                <x-input-error :messages="$errors->get('tiktok')" class="mt-2" />
                            </div>
                            <div class="mb-4">
                                <div class="flex">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-linkedin mr-1" viewBox="0 0 16 16">
                                        <path d="M0 1.146C0 .513.526 0 1.175 0h13.65C15.474 0 16 .513 16 1.146v13.708c0 .633-.526 1.146-1.175 1.146H1.175C.526 16 0 15.487 0 14.854zm4.943 12.248V6.169H2.542v7.225zm-1.2-8.212c.837 0 1.358-.554 1.358-1.248-.015-.709-.52-1.248-1.342-1.248S2.4 3.226 2.4 3.934c0 .694.521 1.248 1.327 1.248zm4.908 8.212V9.359c0-.216.016-.432.08-.586.173-.431.568-.878 1.232-.878.869 0 1.216.662 1.216 1.634v3.865h2.401V9.25c0-2.22-1.184-3.252-2.764-3.252-1.274 0-1.845.7-2.165 1.193v.025h-.016l.016-.025V6.169h-2.4c.03.678 0 7.225 0 7.225z"/>
                                    </svg>
                                    <x-input-label for="linkedin" :value="__('LinkedIn')" />
                                </div>
                                <x-text-input id="linkedin" class="block mt-1 w-full" type="text" name="linkedin" value="{{ old('linkedin', $socials->linkedin) }}" />
                                <x-input-error :messages="$errors->get('linkedin')" class="mt-2" />
                            </div>

                            <x-primary-button>{{ __('Save Socials') }}</x-primary-button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
