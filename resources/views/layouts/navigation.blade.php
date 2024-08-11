<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Top Red Part -->
    <div class="bg-red-600 text-white md:px-20 lg:px-40 xl:px-80">
        <div class="flex justify-between font-bold text-sm py-4">
            <div class="flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-envelope-fill" viewBox="0 0 16 16">
                    <path d="M.05 3.555A2 2 0 0 1 2 2h12a2 2 0 0 1 1.95 1.555L8 8.414zM0 4.697v7.104l5.803-3.558zM6.761 8.83l-6.57 4.027A2 2 0 0 0 2 14h12a2 2 0 0 0 1.808-1.144l-6.57-4.027L8 9.586zm3.436-.586L16 11.801V4.697z"/>
                </svg>
                <a href="" class="mx-1">info@isteducation.com</a>
            </div>
            <div class="flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-geo-alt-fill" viewBox="0 0 16 16">
                    <path d="M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10m0-7a3 3 0 1 1 0-6 3 3 0 0 1 0 6"/>
                </svg>
                <p class="mx-1">Westpoint Building, Mpaka Road, Westlands, Nairobi</p>
            </div>
        </div>
    </div>
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-7">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Dashboard') }}
                    </x-nav-link>
                    @role('employee')
                    <x-nav-link :href="url('users')" :active="request()->routeIs('users')">
                        {{ __('Alumnis') }}
                    </x-nav-link>
                    @endrole
                    <x-nav-link :href="url('jobs')" :active="request()->routeIs('jobs')">
                        {{ __('Jobs') }}
                    </x-nav-link>
                    <x-nav-link :href="url('projects')" :active="request()->routeIs('jobs')">
                        {{ __('Projects') }}
                    </x-nav-link>
                    @role('super-admin|admin')
                    <x-nav-link :href="url('users')" :active="request()->routeIs('users')">
                        {{ __('Users') }}
                    </x-nav-link>
                    @endrole
                    @can('view role')
                    <x-nav-link :href="url('roles')" :active="request()->routeIs('roles')">
                        {{ __('Roles') }}
                    </x-nav-link>
                    @endcan
                    @can('view permission')
                    <x-nav-link :href="url('permissions')" :active="request()->routeIs('permissions')">
                        {{ __('Permissions') }}
                    </x-nav-link>
                    @endcan
                    <x-nav-link :href="url('messages')" :active="request()->routeIs('messages')">
                        {{ __('Messages') }}
                    </x-nav-link>
                </div>
            </div>

            <!-- Settings & Notifications Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                {{-- Notifications --}}
                <x-dropdown align="right">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bell-fill" viewBox="0 0 16 16">
                                <path d="M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2m.995-14.901a1 1 0 1 0-1.99 0A5 5 0 0 0 3 6c0 1.098-.5 6-2 7h14c-1.5-1-2-5.902-2-7 0-2.42-1.72-4.44-4.005-4.901"/>
                                </svg>
                            </div>
                            <div class="relative">
                                <span class="absolute bottom-1 right-1.5 inline-flex items-center justify-center w-4 h-4 text-xs font-bold leading-none text-red-600 bg-red-200 rounded-full">
                                    {{ auth()->user()->unreadNotifications->count() }}
                                </span>
                            </div>
                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                      </x-slot>

                      <x-slot name="content">
                        @foreach(auth()->user()->unreadNotifications as $notification)
                            @if(isset($notification->data['job_url']))
                                <x-dropdown-link :href="$notification->data['job_url']"
                                                  onclick="event.preventDefault(); document.getElementById('mark-as-read-form-{{ $notification->id }}').submit(); setTimeout(function(){ window.location.href = '{{ $notification->data['job_url'] }}'; }, 100);">
                                    {{ $notification->data['job_title'] }}
                                </x-dropdown-link>
                            @elseif(isset($notification->data['message_url']))
                                @php
                                    $senderName = $notification->data['sender_name'] ?? 'A user';
                                @endphp
                                <x-dropdown-link :href="$notification->data['message_url']"
                                                  onclick="event.preventDefault(); document.getElementById('mark-as-read-form-{{ $notification->id }}').submit(); setTimeout(function(){ window.location.href = '{{ $notification->data['message_url'] }}'; }, 100);">
                                    {{ $senderName }} {{ __('has sent you a message.') }}
                                </x-dropdown-link>
                            @endif                
                            <form id="mark-as-read-form-{{ $notification->id }}" action="{{ url('notifications/' . $notification->id) }}" method="post" style="display: none;">
                                @csrf
                                @method('PATCH')
                            </form>
                        @endforeach
                    
                        @if(auth()->user()->unreadNotifications->isEmpty())
                            <x-dropdown-link :href="url('')" disabled>
                                {{ __('There are no new notifications') }}
                            </x-dropdown-link>
                        @endif
                    
                        @if(auth()->user()->unreadNotifications->isNotEmpty())
                            <x-dropdown-link :href="url('notifications/clear')" onclick="event.preventDefault(); document.getElementById('clear-notifications-form').submit();">
                                {{ __('Clear all notifications') }}
                            </x-dropdown-link>
                            <form id="clear-notifications-form" action="{{ url('notifications/clear') }}" method="post" style="display: none;">
                                @csrf
                                @method('DELETE')
                            </form>
                        @endif
                    </x-slot>                                     
                </x-dropdown>

                {{-- Settings --}}
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                            @role('alumni')
                            <div class="mr-2">
                                @if (Auth::user()->profile_picture)
                                    <img src="{{ Storage::url(Auth::user()->profile_picture) }}" alt="Profile Picture" class="w-8 h-8 rounded-full">
                                @else
                                    <img src="{{ asset('images/default-profile.png') }}" alt="Default Profile Picture" class="w-8 h-8 rounded-full">
                                @endif
                            </div>
                            @endrole                          
                            <div>{{ Auth::user()->name }}</div>

                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        @role('alumni')
                        <x-dropdown-link :href="url('profile/'.auth()->user()->id)">
                            {{ __('Profile') }}
                        </x-dropdown-link>
                        @endrole
                        @role('super-admin|admin|employee')
                        <x-dropdown-link :href="url('profile')">
                            {{ __('Profile') }}
                        </x-dropdown-link>
                        @endrole

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="url('jobs')" :active="request()->routeIs('jobs')">
                {{ __('Jobs') }}
            </x-responsive-nav-link>
            @can('view user')
            <x-responsive-nav-link :href="url('users')" :active="request()->routeIs('users')">
                {{ __('Users') }}
            </x-responsive-nav-link>
            @endcan
            @can('view role')
            <x-responsive-nav-link :href="url('roles')" :active="request()->routeIs('roles')">
                {{ __('Roles') }}
            </x-responsive-nav-link>
            @endcan
            @can('view permission')
            <x-responsive-nav-link :href="url('permissions')" :active="request()->routeIs('permissions')">
                {{ __('Permissions') }}
            </x-responsive-nav-link>
            @endcan
        </div>

        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="flex px-4 text-gray-500">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bell-fill" viewBox="0 0 16 16">
                    <path d="M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2m.995-14.901a1 1 0 1 0-1.99 0A5 5 0 0 0 3 6c0 1.098-.5 6-2 7h14c-1.5-1-2-5.902-2-7 0-2.42-1.72-4.44-4.005-4.901"/>
                </svg>
                <p class="px-2">Notifications</p>
            </div>

            <div class="px-4 py-2">
                <p>There are no new notifications</p>
            </div>
        </div>
        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.view')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
