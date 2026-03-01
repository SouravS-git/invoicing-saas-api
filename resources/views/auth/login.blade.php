<x-layouts.app>
    <x-slot:title>SignUp&nbsp;|&nbsp;{{ config('app.name', 'Laravel') }}</x-slot:title>
    <div class="min-h-screen bg-slate-950 flex flex-col justify-center py-12 sm:px-6 lg:px-8 relative overflow-hidden">

        <div class="absolute top-0 right-0 -translate-y-1/2 translate-x-1/4 w-96 h-96 bg-emerald-500/10 rounded-full blur-[100px]"></div>
        <div class="absolute bottom-0 left-0 translate-y-1/2 -translate-x-1/4 w-96 h-96 bg-emerald-500/5 rounded-full blur-[100px]"></div>

        <div class="sm:mx-auto sm:w-full sm:max-w-md relative z-10">
            <div class="flex justify-center">
                <div class="h-12 w-12 bg-emerald-500 rounded-xl flex items-center justify-center text-slate-900 font-bold text-2xl shadow-lg shadow-emerald-500/20">
                    <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                        <path fill-rule="evenodd" d="M5.617 2.076a1 1 0 0 1 1.09.217L8 3.586l1.293-1.293a1 1 0 0 1 1.414 0L12 3.586l1.293-1.293a1 1 0 0 1 1.414 0L16 3.586l1.293-1.293A1 1 0 0 1 19 3v18a1 1 0 0 1-1.707.707L16 20.414l-1.293 1.293a1 1 0 0 1-1.414 0L12 20.414l-1.293 1.293a1 1 0 0 1-1.414 0L8 20.414l-1.293 1.293A1 1 0 0 1 5 21V3a1 1 0 0 1 .617-.924ZM9 7a1 1 0 0 0 0 2h6a1 1 0 1 0 0-2H9Zm0 4a1 1 0 1 0 0 2h6a1 1 0 1 0 0-2H9Zm0 4a1 1 0 1 0 0 2h6a1 1 0 1 0 0-2H9Z" clip-rule="evenodd"/>
                    </svg>
                </div>
            </div>
            <h2 class="mt-6 text-center text-3xl font-extrabold text-white">
                Sign in to your account
            </h2>
            <p class="mt-2 text-center text-sm text-slate-400">
                Welcome back.
            </p>
        </div>

        <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md relative z-10">
            <div class="bg-slate-900 py-8 px-4 shadow-2xl border border-slate-800 rounded-2xl sm:px-10 backdrop-blur-sm">
                <form class="space-y-5" action="{{ route('login') }}" method="POST">
                    @csrf

                    <x-form-field label="Email" type="email" name="email" placeholder="Enter registered email id*" required autofocus />
                    <x-form-field label="Password" type="password" name="password" required />

                    <div>
                        <button type="submit" class="cursor-pointer w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-lg text-sm font-bold text-slate-900 bg-emerald-500 hover:bg-emerald-400 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-slate-900 focus:ring-emerald-500 transition-all duration-200">
                            Sign In
                        </button>
                    </div>
                </form>

                <div class="mt-6 text-center">
                    <p class="text-sm text-slate-500">
                        Don't have an account?
                        <a href="{{ route('register') }}" class="font-semibold text-emerald-400 hover:text-emerald-300 transition">Register here</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
