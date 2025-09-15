<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('responsable.interface') }}">
                        <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-20 w-auto">
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    {{-- Tableau de bord --}}
                    <x-nav-link :href="route('responsable.interface')" :active="request()->routeIs('responsable.interface')">
                        {{ __('Dashboard') }}
                    </x-nav-link>

                    {{-- Demandes --}}
                    <x-nav-link :href="route('responsable.demandes.index')" :active="request()->routeIs('responsable.demandes.*')">
                        {{ __('Demandes') }}
                    </x-nav-link>

                    {{-- Documents --}}
                    <x-nav-link :href="route('responsable.documents.index')" :active="request()->routeIs('responsable.documents.*')">
                        {{ __('Documents') }}
                    </x-nav-link>

                    {{-- Encadrants --}}
                    <x-nav-link :href="route('responsable.encadrants.index')" :active="request()->routeIs('responsable.encadrants.*')">
                        {{ __('Encadrants') }}
                    </x-nav-link>
                </div>
            </div>

            <!-- Zone droite -->
            <div class="hidden sm:flex sm:items-center sm:ms-6 space-x-4">

                <!-- Icône notifications -->
                <button class="relative text-gray-600 hover:text-gray-100 focus:outline-none">
                    <svg class="w-8 h-8 text-gray-600" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M15 17h5l-1.405-1.405A2.032 2.032 0 
                              0118 14.158V11a6.002 6.002 0 
                              00-4-5.659V5a2 2 0 10-4 0v.341C7.67 
                              6.165 6 8.388 6 11v3.159c0 
                              .538-.214 1.055-.595 
                              1.436L4 17h5m6 0v1a3 3 0 
                              11-6 0v-1m6 0H9" />
                    </svg>
                    <!-- pastille rouge -->
                    <span class="absolute top-0 right-0 inline-block w-2 h-2 bg-red-500 rounded-full"></span>
                </button>

                <!-- Profil Dropdown -->
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="flex items-center text-sm rounded-full focus:outline-none">
                            <img class="h-8 w-8 rounded-full object-cover"
                                 src="{{ Auth::user()->profile_photo_url ?? 'https://ui-avatars.com/api/?name='.Auth::user()->name }}"
                                 alt="{{ Auth::user()->name }}" />
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Mon Profil') }}
                        </x-dropdown-link>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault(); this.closest('form').submit();">
                                {{ __('Déconnexion') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open"
                        class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 
                               hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 
                               transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" 
                              class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                              d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" 
                              class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                              d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('responsable.interface')" :active="request()->routeIs('responsable.interface')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('responsable.demandes.index')" :active="request()->routeIs('responsable.demandes.*')">
                {{ __('Demandes') }}
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('responsable.documents.index')" :active="request()->routeIs('responsable.documents.*')">
                {{ __('Documents') }}
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('responsable.encadrants.index')" :active="request()->routeIs('responsable.encadrants.*')">
                {{ __('Encadrants') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Mon Profil') }}
                </x-responsive-nav-link>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault(); this.closest('form').submit();">
                        {{ __('Déconnexion') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
