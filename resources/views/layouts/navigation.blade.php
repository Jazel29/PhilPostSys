<nav x-data="{ open: false }" class="px-10 bg-white border-b shadow-sm border-gray-100 sticky top-0 z-50">

    <style>
        .flex {
            border-radius: 100px;
        }

        .nav-text {
            margin-left: -35px;
        }
    </style>

    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <!-- Logo -->
            <div class="flex items-center">
                <div class="shrink-0">
                    <img src="{{ asset('assets/PHLPOSTLogo.png') }}" alt="PhilPostLogo" class="h-6 fill-current text-gray-800" />
                </div>
            </div>

            <!-- Title -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <span style="font-weight:900; font-size: 19px;">PHILPOST </span> &nbsp;
                <span style="font-weight: medium; color: #888; font-size: 19px;">RRR Tracking</span>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <!-- Dropdown Trigger -->
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                            <div>{{ Auth::user()->name }}</div>
                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <!-- Dropdown Content -->
                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <!-- Existing hamburger button -->
                <button @click="open = !open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': !open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            
                <!-- Arrow to close/shrink the navigation -->
                <button @click="open = false" class="ml-2 p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': !open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
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
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>

<div x-show="open" @click.away="open = false" class="fixed inset-0 bg-gray-900 bg-opacity-50 sm:hidden"></div>

<div class="fixed bottom-0 w-full md:w-1/6 bg-white md:h-screen lg:pt-16" :class="{ '-translate-x-full': !open, 'translate-x-0': open }">
    <div class="text-center md:block hidden items-center text-black mt-3">
        <div class="hover:bg-gray-300 rounded-md mx-3">
            <a href="{{ route('dashboard') }}" class="flex items-center p-2 hover:bg-gray-300 rounded-md w-full">
                <div class="row">
                    <div class="col">
                        <i class="fa-solid fa-house"></i> <!-- Replace with icon from CDN -->
                    </div>
                    <div class="col">
                        <span class="text-19">{{ __('Dashboard') }}</span>
                    </div>
                </div>
            </a>
        </div>
        <div class="hover:bg-gray-300 rounded-md mx-3">
            <a href="{{ route('formTest') }}" class="flex items-center p-2 hover:bg-gray-300 rounded-md w-full">
                <div class="row">
                    <div class="col">
                        <i class="fa-solid fa-magnifying-glass"></i> <!-- Replace with icon from CDN -->
                    </div>
                    <div class="col">
                        <span class="text-19">{{ __('Trace') }}</span>
                    </div>
                </div>
            </a>
        </div>
        <div class="hover:bg-gray-300 rounded-md mx-3">
            <a href="{{ route('new_transmittal') }}" class="flex items-center p-2 hover:bg-gray-300 rounded-md w-full">
                <div class="row">
                    <div class="col">
                        <i class="fa-solid fa-pen-nib"></i> <!-- Replace with icon from CDN -->
                    </div>
                    <div class="col" style="white-space: nowrap;">
                        <span>{{ __('    Transmittal') }}</span>
                    </div>
                </div>
            </a>
        </div>
        <div class="hover:bg-gray-300 rounded-md mx-3">
            <a href="{{ route('new.addressee') }}" class="flex items-center p-2 hover:bg-gray-300 rounded-md w-full">
                <div class="row">
                    <div class="col">
                        <i class="fa-solid fa-address-book"></i> <!-- Replace with icon from CDN -->
                    </div>
                    <div class="col" style="white-space: nowrap;">
                        <span>{{ __('New Addressee') }}</span>
                    </div>
                </div>
            </a>
        </div>
        <div class="hover:bg-gray-300 rounded-md mx-3">
            <a href="{{ route('show.addressee') }}" class="flex items-center p-2 hover:bg-gray-300 rounded-md w-full">
                <div class="row">
                    <div class="col">
                        <i class="fa-solid fa-list"></i> <!-- Replace with icon from CDN -->
                    </div>
                    <div class="col" style="white-space: nowrap;">
                        <span>{{ __('Addressee List') }}</span>
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>
