<div class="bg-slate-950 text-slate-400 border-b border-slate-900 h-16 flex items-center">
    <div class="max-w-7xl mx-auto px-4 w-full flex justify-between items-center">

        <div class="flex items-center gap-2">
            <div class="h-8 w-8 bg-emerald-500 rounded flex items-center justify-center text-slate-900 font-bold">
                <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                    <path fill-rule="evenodd" d="M5.617 2.076a1 1 0 0 1 1.09.217L8 3.586l1.293-1.293a1 1 0 0 1 1.414 0L12 3.586l1.293-1.293a1 1 0 0 1 1.414 0L16 3.586l1.293-1.293A1 1 0 0 1 19 3v18a1 1 0 0 1-1.707.707L16 20.414l-1.293 1.293a1 1 0 0 1-1.414 0L12 20.414l-1.293 1.293a1 1 0 0 1-1.414 0L8 20.414l-1.293 1.293A1 1 0 0 1 5 21V3a1 1 0 0 1 .617-.924ZM9 7a1 1 0 0 0 0 2h6a1 1 0 1 0 0-2H9Zm0 4a1 1 0 1 0 0 2h6a1 1 0 1 0 0-2H9Zm0 4a1 1 0 1 0 0 2h6a1 1 0 1 0 0-2H9Z" clip-rule="evenodd"/>
                </svg>
            </div>
            <span class="text-white font-bold tracking-tight text-md">
                @auth
                    <a wire:navigate href="{{ route('home') }}">{{ Auth::user()->tenant->name }}</a>
                @else
                    <a wire:navigate href="{{ route('home') }}">{{ config('app.name') }}</a>
                @endauth
            </span>
        </div>

        @guest
            <div class="hidden md:flex items-center space-x-8 text-sm font-medium text-slate-300">
                <a href="#" class="hover:text-emerald-400 transition">Features</a>
                <a href="#" class="hover:text-emerald-400 transition">Pricing</a>
                <a href="#" class="hover:text-emerald-400 transition">Documentation</a>
            </div>

            <div class="flex items-center gap-4">
                <a href="{{ route('login') }}" class="text-sm font-medium text-slate-300 hover:text-white">Login</a>
                <a href="{{ route('register') }}" class="bg-emerald-600 hover:bg-emerald-500 text-white px-4 py-1.5 rounded-md text-sm font-semibold transition shadow-lg shadow-emerald-900/20">
                    Signup for free
                </a>
            </div>
        @endguest

        @auth
            <div class="hidden md:flex items-center space-x-8 text-sm font-medium text-slate-300">
                <a wire:navigate href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'text-emerald-400' : '' }} hover:text-emerald-400 transition">Dashboard</a>
                <a wire:navigate href="{{ route('invoices.index') }}" class="{{ request()->routeIs('invoices.index') ? 'text-emerald-400' : '' }} hover:text-emerald-400 transition">Invoices</a>
                <a wire:navigate href="{{ route('billing') }}" class="{{ request()->routeIs('billing') ? 'text-emerald-400' : '' }} hover:text-emerald-400 transition">Credits</a>
            </div>

            <div class="flex items-center gap-4">
                <form id="logout_form" method="POST" action="{{ route('logout') }}" hidden="">
                    @csrf
                    @method('DELETE')
                </form>
                <button form="logout_form" class="cursor-pointer bg-orange-600 hover:bg-orange-500 text-white px-4 py-1.5 rounded-md text-sm font-semibold transition shadow-lg shadow-emerald-900/20">
                    Logout
                </button>
            </div>
        @endauth

    </div>
</div>
