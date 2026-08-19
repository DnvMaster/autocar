<header class="h-20 bg-white border-b border-gray-200 flex items-center justify-between px-6">
    <div>
        <h1 class="text-lg font-semibold text-gray-900">@yield('page-title', 'Dashboard')</h1>
        <p class="text-sm text-gray-500">{{ __('ui.topbar.fleet_management') }}</p>
    </div>
    <div class="flex items-center gap-5">
        <div class="hidden md:flex items-center">
            <div class="relative">
                <input type="text" placeholder="{{ __('ui.topbar.search') }}" class="w-64 rounded-lg border border-gray-200 bg-gray-50 px-4 py-2 pl-10 text-sm focus:border-blue-500 focus:ring-blue-500">
                <span class="absolute left-3 top-2.5 text-gray-400"> ⌕</span>
            </div>
        </div>
        <button class="relative w-10 h-10 rounded-lg hover:bg-gray-100 flex items-center justify-center">
            <span>🔔</span>
            <span class="absolute top-2 right-2 w-2 h-2 rounded-full bg-red-500"></span>
        </button>
        <div class="flex items-center gap-3">
            <div class="hidden sm:block text-right">
                <div class="text-sm font-medium">
                    {{ auth()->user()->name ?? 'User' }}
                </div>
                <div class="text-xs text-gray-500">
                    {{ __('ui.topbar.administrator') }}
                </div>
            </div>
            <div class="w-10 h-10 rounded-full bg-blue-600 text-white flex items-center justify-center font-semibold">
                {{ strtoupper(substr(auth()->user()->name ?? 'U', 0, 1)) }}
            </div>
        </div>
    </div>
</header>
