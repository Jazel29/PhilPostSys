<nav x-data="{ open: false }" class="px-4 sm:px-10 bg-white border-b shadow-sm border-gray-100 sticky top-0 z-40">
    <style>
        .flex {
            border-radius: 100px;
        }

        .nav-text {
            margin-left: -35px;
        }
    </style>

    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto h-16 flex items-center justify-between">
        <!-- Logo -->
        <div>
            <img src="{{ asset('assets/PHLPOSTLogo.png') }}" alt="PhilPostLogo" class="h-6 fill-current text-gray-800" />
        </div>

        <!-- Title -->
        <div class="hidden sm:flex sm:items-center sm:ms-6">
            <span style="font-weight:900; font-size: 19px;">PHILPOST </span> &nbsp;
            <span style="font-weight: medium; color: #888; font-size: 19px;">RRR Tracking</span>
        </div>

        <!-- Hamburger -->
        <div class="sm:hidden flex items-center">
            <button @click="open = !open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                    <path :class="{'hidden': open, 'inline-flex': !open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    <path :class="{'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
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
                    <div class="col hidden md:block">
                        <i class="fa-solid fa-chart-simple"></i>
                    </div>
                    <div class="col">
                        <span class="text-sm">{{ __('Dashboard') }}</span>
                    </div>
                </div>
            </a>
        </div>
        <div class="hover:bg-gray-300 rounded-md mx-3">
            <a href="{{ route('formTest') }}" class="flex items-center p-2 hover:bg-gray-300 rounded-md w-full">
                <div class="row">
                    <div class="col hidden md:block">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </div>
                    <div class="col" style="white-space: nowrap;">
                        <span class="text-sm">{{ __('Trace Transmittals') }}</span>
                    </div>
                </div>
            </a>
        </div>
        <div class="hover:bg-gray-300 rounded-md mx-3">
            <a href="{{ route('new_transmittal') }}" class="flex items-center p-2 hover:bg-gray-300 rounded-md w-full">
                <div class="row">
                    <div class="col hidden md:block">
                        <i class="fa-solid fa-pen-nib"></i>
                    </div>
                    <div class="col" style="white-space: nowrap;">
                        <span class="text-sm">{{ __('Add New Transmittal') }}</span>
                    </div>
                </div>
            </a>
        </div>
        <div class="hover:bg-gray-300 rounded-md mx-3">
            <a href="{{ route('new.addressee') }}" class="flex items-center p-2 hover:bg-gray-300 rounded-md w-full">
                <div class="row">
                    <div class="col hidden md:block">
                        <i class="fa-solid fa-plus"></i>
                    </div>
                    <div class="col" style="white-space: nowrap;">
                        <span class="text-sm">{{ __('Add New Addressee') }}</span>
                    </div>
                </div>
            </a>
        </div>
        <div class="hover:bg-gray-300 rounded-md mx-3">
            <a href="{{ route('show.addressee') }}" class="flex items-center p-2 hover:bg-gray-300 rounded-md w-full">
                <div class="row">
                    <div class="col hidden md:block">
                        <i class="fa-solid fa-book"></i>
                    </div>
                    <div class="col" style="white-space: nowrap;">
                        <span class="text-sm">{{ __('Addressee List') }}</span>
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>
