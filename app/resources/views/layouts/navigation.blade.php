@php
    use Illuminate\Support\Str;

    // Define translatable routes
    $translatableRoutes = ['', 'welcome', 'privacy', 'terms', 'dashboard', 'contact'];

    $currentPath = request()->path(); // e.g., '', 'dashboard', 'ru/dashboard'
    $isRu = request()->is('ru') || request()->is('ru/*');

    // Normalize the path
    $normalizedPath = $currentPath === 'ru'
        ? ''
        : ($isRu ? Str::after($currentPath, 'ru/') : $currentPath);

    $shouldShowToggle = in_array($normalizedPath, $translatableRoutes);

    // Determine the target URL
    $targetUrl = $isRu
        ? url($normalizedPath ?: '/')
        : url(path: 'ru' . ($currentPath ? '/' . $currentPath : ''));
@endphp

<style>
.flag-emoji {
    font-family: 
        'Apple Color Emoji', 
        'Segoe UI Emoji', 
        'Noto Color Emoji', 
        'EmojiOne Color', 
        'Twemoji Mozilla', 
        sans-serif;
    font-size: 1.5rem; /* Adjust size as needed */
    line-height: 1;
}

</style>

<nav x-data="{ open: false }" class="bg-white border-b border-gray-100 dark:bg-gray-800 dark:border-gray-700">
    <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <!-- Left: Logo + Nav Links -->
            <div class="flex">
                <!-- Logo -->
                <div class="flex items-center shrink-0">
                    <a href="{{ url('/') }}">
                        <img src="{{ asset('images/milestar_logo.jpg') }}" class="w-auto h-8" alt="Milestar Logo">
                    </a>
                </div>

                <!-- Desktop Nav Links -->
                <div class="hidden sm:flex sm:space-x-8 sm:ml-10">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('dashboard') }}
                    </x-nav-link>
                </div>
            </div>

            <!-- Right: Auth + Language -->
            <div class="hidden sm:flex sm:items-center sm:space-x-4">
                <!-- Language Switcher -->
               @if ($shouldShowToggle)
    <a href="{{ $targetUrl }}"
       class="ml-2 mr-2 text-sm font-medium text-gray-600 hover:text-blue-600 dark:text-gray-300 dark:hover:text-blue-400 flag-emoji">
        @if ($isRu)
    <img src="https://cdnjs.cloudflare.com/ajax/libs/twemoji/14.0.2/72x72/1f1f3-1f1ff.png" alt="NG" width="20" class="inline">
@else
    <img src="https://cdnjs.cloudflare.com/ajax/libs/twemoji/14.0.2/72x72/1f1f7-1f1fa.png" alt="RU" width="20" class="inline">
@endif

    </a>
@endif


                <!-- Auth Dropdown / Links -->
                @auth
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-3 py-2 text-sm font-medium text-gray-500 bg-white border rounded-md dark:text-gray-400 dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300">
                                <div>{{ Auth::user()->name }}</div>
                                <svg class="w-4 h-4 ml-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 011.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/>
                                </svg>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile.edit')">{{ __('profile') }}</x-dropdown-link>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();">
                                    {{ __('logout') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                @else
                    <a href="{{ route('login') }}" class="ml-2 mr-2 text-sm font-medium text-gray-600 hover:text-blue-600 dark:text-gray-300 dark:hover:text-blue-400">
                        {{ __('login') }}
                    </a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="ml-2 mr-2 text-sm font-medium text-gray-600 hover:text-blue-600 dark:text-gray-300 dark:hover:text-blue-400">
                            {{ __('register') }}
                        </a>
                    @endif
                @endauth
            </div>

            <!-- Mobile Hamburger -->
            <div class="flex items-center sm:hidden">
                <button @click="open = ! open" class="p-2 text-gray-400 rounded-md hover:text-gray-500 hover:bg-gray-100 dark:hover:text-gray-300 dark:hover:bg-gray-900">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex"
                              stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M4 6h16M4 12h16M4 18h16"/>
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden"
                              stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <!-- Mobile Nav Links -->
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('dashboard') }}
            </x-responsive-nav-link>
        </div>

        <!-- Mobile Language -->
        @if ($shouldShowToggle)
    <div class="px-4 py-2 border-t border-gray-200 dark:border-gray-600">
        <a href="{{ $targetUrl }}"
           class="ml-2 mr-2 text-sm font-medium text-gray-600 hover:text-blue-600 dark:text-gray-300 dark:hover:text-blue-400 flag-emoji">
            @if ($isRu)
    <img src="https://cdnjs.cloudflare.com/ajax/libs/twemoji/14.0.2/72x72/1f1f3-1f1ff.png" alt="NG" width="20" class="inline">
@else
    <img src="https://cdnjs.cloudflare.com/ajax/libs/twemoji/14.0.2/72x72/1f1f7-1f1fa.png" alt="RU" width="20" class="inline">
@endif

        </a>
    </div>
@endif


        <!-- Mobile Auth Links -->
        <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
            <div class="px-4">
                @auth
                    <div class="text-base font-medium text-gray-800 dark:text-gray-200">{{ Auth::user()->name }}</div>
                    <div class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ Auth::user()->email }}</div>
                @else
                    <div class="text-base font-medium text-gray-800 dark:text-gray-200">{{ __('navigation.guest') }}</div>
                    <div class="text-sm font-medium text-gray-500">{{ __('navigation.not_logged_in') }}</div>
                @endauth
            </div>

            <div class="mt-3 space-y-1">
                @auth
                    <x-responsive-nav-link :href="route('profile.edit')">{{ __('profile') }}</x-responsive-nav-link>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-responsive-nav-link href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();">
                            {{ __('logout') }}
                        </x-responsive-nav-link>
                    </form>
                @else
                    <x-responsive-nav-link :href="route('login')">{{ __('login') }}</x-responsive-nav-link>
                    @if (Route::has('register'))
                        <x-responsive-nav-link :href="route('register')">{{ __('register') }}</x-responsive-nav-link>
                    @endif
                @endauth
            </div>
        </div>
    </div>
</nav>
