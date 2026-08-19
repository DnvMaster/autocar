<aside class="hidden lg:flex lg:flex-col w-64 bg-slate-950 text-white min-h-screen">

    {{-- Logo --}}
    <div class="h-20 flex items-center px-6 border-b border-slate-800">

        <a href="{{ route('dashboard') }}" class="flex items-center gap-3">

            <div class="w-10 h-10 rounded-xl bg-blue-600 flex items-center justify-center font-bold text-lg">
                A
            </div>

            <div>
                <div class="font-bold text-lg leading-none">
                    AutoCar
                </div>

                <div class="text-xs text-slate-400 mt-1">
                    Fleet CRM
                </div>
            </div>

        </a>

    </div>


    {{-- Navigation --}}
    <nav class="flex-1 px-4 py-6 space-y-8 overflow-y-auto">

        {{-- Main --}}
        <div>

            <div class="px-3 mb-3 text-xs font-semibold uppercase tracking-wider text-slate-500">
                Main
            </div>

            <div class="space-y-1">

                <a href="{{ route('dashboard') }}"
                   class="flex items-center gap-3 px-3 py-2.5 rounded-lg
                   hover:bg-slate-800 transition
                   {{ request()->routeIs('dashboard') ? 'bg-blue-600 text-white' : 'text-slate-300' }}">

                    <span>▣</span>
                    <span>Dashboard</span>

                </a>

            </div>

        </div>


        {{-- Operations --}}
        <div>

            <div class="px-3 mb-3 text-xs font-semibold uppercase tracking-wider text-slate-500">
                Operations
            </div>

            <div class="space-y-1">

                <a href="#"
                   class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-slate-300 hover:bg-slate-800 transition">

                    <span>▤</span>
                    <span>Rentals</span>

                </a>

                <a href="#"
                   class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-slate-300 hover:bg-slate-800 transition">

                    <span>🚗</span>
                    <span>Vehicles</span>

                </a>

                <a href="#"
                   class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-slate-300 hover:bg-slate-800 transition">

                    <span>♙</span>
                    <span>Customers</span>

                </a>

            </div>

        </div>


        {{-- Fleet --}}
        <div>

            <div class="px-3 mb-3 text-xs font-semibold uppercase tracking-wider text-slate-500">
                Fleet
            </div>

            <div class="space-y-1">

                <a href="#"
                   class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-slate-300 hover:bg-slate-800 transition">

                    <span>🔧</span>
                    <span>Maintenance</span>

                </a>

                <a href="#"
                   class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-slate-300 hover:bg-slate-800 transition">

                    <span>€</span>
                    <span>Expenses</span>

                </a>

            </div>

        </div>


        {{-- Finance --}}
        <div>

            <div class="px-3 mb-3 text-xs font-semibold uppercase tracking-wider text-slate-500">
                Finance
            </div>

            <div class="space-y-1">

                <a href="#"
                   class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-slate-300 hover:bg-slate-800 transition">

                    <span>▣</span>
                    <span>Contracts</span>

                </a>

                <a href="#"
                   class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-slate-300 hover:bg-slate-800 transition">

                    <span>▤</span>
                    <span>Invoices</span>

                </a>

                <a href="#"
                   class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-slate-300 hover:bg-slate-800 transition">

                    <span>€</span>
                    <span>Payments</span>

                </a>

            </div>

        </div>


        {{-- System --}}
        <div>

            <div class="px-3 mb-3 text-xs font-semibold uppercase tracking-wider text-slate-500">
                System
            </div>

            <div class="space-y-1">

                <a href="#"
                   class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-slate-300 hover:bg-slate-800 transition">

                    <span>♙</span>
                    <span>Users</span>

                </a>

                <a href="#"
                   class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-slate-300 hover:bg-slate-800 transition">

                    <span>⚙</span>
                    <span>Settings</span>

                </a>

            </div>

        </div>

    </nav>


    {{-- User --}}
    <div class="p-4 border-t border-slate-800">

        <div class="flex items-center gap-3">

            <div class="w-10 h-10 rounded-full bg-blue-600 flex items-center justify-center font-semibold">
                {{ strtoupper(substr(auth()->user()->name ?? 'U', 0, 1)) }}
            </div>

            <div class="min-w-0">

                <div class="text-sm font-medium truncate">
                    {{ auth()->user()->name ?? 'User' }}
                </div>

                <div class="text-xs text-slate-500 truncate">
                    {{ auth()->user()->email ?? '' }}
                </div>

            </div>

        </div>

    </div>

</aside>
