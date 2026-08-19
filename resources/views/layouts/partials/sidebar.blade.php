<aside class="hidden lg:flex lg:flex-col w-64 bg-slate-950 text-white min-h-screen">
    <div class="h-20 flex items-center px-6 border-b border-slate-800">
        <a href="{{ route('dashboard') }}" class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-xl bg-blue-600 flex items-center justify-center font-bold text-lg">A</div>
            <div>
                <div class="font-bold text-lg leading-none">{{ __('ui.brand.name') }}</div>
                <div class="text-xs text-slate-400 mt-1">{{ __('ui.brand.subtitle') }}</div>
            </div>
        </a>
    </div>
    <nav class="flex-1 px-4 py-6 space-y-8 overflow-y-auto">
        <div>
            <div class="px-3 mb-3 text-xs font-semibold uppercase tracking-wider text-slate-500">{{ __('ui.navigation.main') }}</div>
            <div class="space-y-1">
                <a href="{{ route('dashboard') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg hover:bg-slate-800 transition {{ request()->routeIs('dashboard') ? 'bg-blue-600 text-white' : 'text-slate-300' }}">
                    <span>▣</span>
                    <span>{{ __('ui.navigation.dashboard') }}</span>
                </a>
            </div>
        </div>
        <div>
            <div class="px-3 mb-3 text-xs font-semibold uppercase tracking-wider text-slate-500">{{ __('ui.navigation.operations') }}</div>
            <div class="space-y-1">
                <a href="#" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-slate-300 hover:bg-slate-800 transition">
                    <span>▤</span>
                    <span>{{ __('ui.navigation.rentals') }}</span>
                </a>
                <a href="#" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-slate-300 hover:bg-slate-800 transition">
                    <span>🚗</span>
                    <span>{{ __('ui.navigation.vehicles') }}</span>

                </a>
                <a href="#" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-slate-300 hover:bg-slate-800 transition">
                    <span>♙</span>
                    <span>{{ __('ui.navigation.customers') }}</span>
                </a>
            </div>
        </div>
        <div>
            <div class="px-3 mb-3 text-xs font-semibold uppercase tracking-wider text-slate-500">{{ __('ui.navigation.fleet') }}</div>
            <div class="space-y-1">
                <a href="#" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-slate-300 hover:bg-slate-800 transition">
                    <span>🔧</span>
                    <span>{{ __('ui.navigation.maintenance') }}</span>
                </a>
                <a href="#" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-slate-300 hover:bg-slate-800 transition">
                    <span>€</span>
                    <span>{{ __('ui.navigation.expenses') }}</span>
                </a>
            </div>
        </div>
        <div>
            <div class="px-3 mb-3 text-xs font-semibold uppercase tracking-wider text-slate-500">{{ __('ui.navigation.finance') }}</div>
            <div class="space-y-1">
                <a href="#" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-slate-300 hover:bg-slate-800 transition">
                    <span>▣</span>
                    <span>{{ __('ui.navigation.contracts') }}</span>
                </a>
                <a href="#" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-slate-300 hover:bg-slate-800 transition">
                    <span>▤</span>
                    <span>{{ __('ui.navigation.invoices') }}</span>
                </a>
                <a href="#" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-slate-300 hover:bg-slate-800 transition">
                    <span>€</span>
                    <span>{{ __('ui.navigation.payments') }}</span>
                </a>
            </div>
        </div>
        <div>
            <div class="px-3 mb-3 text-xs font-semibold uppercase tracking-wider text-slate-500">{{ __('ui.navigation.system') }}</div>
            <div class="space-y-1">
                <a href="#" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-slate-300 hover:bg-slate-800 transition">
                    <span>♙</span>
                    <span>{{ __('ui.navigation.users') }}</span>
                </a>
                <a href="#" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-slate-300 hover:bg-slate-800 transition">
                    <span>⚙</span>
                    <span>{{ __('ui.navigation.settings') }}</span>
                </a>
            </div>
        </div>
    </nav>
    <div class="p-4 border-t border-slate-800">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-full bg-blue-600 flex items-center justify-center font-semibold">
                {{ strtoupper(substr(auth()->user()->name ?? 'U', 0, 1)) }}
            </div>
            <div class="min-w-0">
                <div class="text-sm font-medium truncate">{{ auth()->user()->name ?? 'User' }}</div>
                <div class="text-xs text-slate-500 truncate">{{ auth()->user()->email ?? '' }}</div>
            </div>
        </div>
    </div>
</aside>
