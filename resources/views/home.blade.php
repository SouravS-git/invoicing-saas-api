<x-layouts.app>
    <section class="relative bg-slate-900 pt-20 pb-32 overflow-hidden">
        <div class="absolute top-0 left-1/2 -translate-x-1/2 w-full h-full opacity-10 pointer-events-none">
            <div class="absolute top-[-10%] left-1/4 w-96 h-96 bg-emerald-500 rounded-full blur-[120px]"></div>
        </div>

        <div class="relative max-w-7xl mx-auto px-6 lg:px-8 text-center">
        <span class="inline-flex items-center rounded-full bg-emerald-500/10 px-3 py-1 text-sm font-medium text-emerald-400 ring-1 ring-inset ring-emerald-500/20 mb-8">
            Now in Beta: Multi-Currency Support
        </span>

            <h1 class="text-4xl font-extrabold tracking-tight text-white sm:text-6xl">
                Invoicing for the modern <br/>
                <span class="text-transparent bg-clip-text bg-linear-to-r from-emerald-400 to-cyan-400">
                Multi-Tenant Enterprise.
            </span>
            </h1>

            <p class="mt-6 text-lg leading-8 text-slate-400 max-w-2xl mx-auto">
                Scale your business effortlessly. Manage multiple entities, automate recurring billing, and get paid faster with our developer-first invoicing engine.
            </p>

            <div class="mt-10 flex items-center justify-center gap-x-6">
                <a href="{{ route('register.create') }}" class="rounded-xl bg-emerald-600 px-8 py-4 text-sm font-bold text-white shadow-lg shadow-emerald-900/40 hover:bg-emerald-500 transition-all duration-200">
                    Register Here
                </a>
            </div>

            <div class="mt-16 flow-root sm:mt-24">
                <div class="-m-2 rounded-xl bg-slate-800/50 p-2 ring-1 ring-inset ring-slate-700 lg:-m-4 lg:rounded-2xl lg:p-4 backdrop-blur-sm">
                    <div class="bg-slate-900 rounded-lg border border-slate-700 shadow-2xl overflow-hidden">
                        <div class="bg-slate-800 px-4 py-2 flex items-center gap-2 border-b border-slate-700">
                            <div class="flex gap-1.5">
                                <div class="w-3 h-3 rounded-full bg-slate-600"></div>
                                <div class="w-3 h-3 rounded-full bg-slate-600"></div>
                                <div class="w-3 h-3 rounded-full bg-slate-600"></div>
                            </div>
                            <div class="mx-auto bg-slate-900 rounded px-20 py-1 text-[10px] text-slate-500">app.invoify.com</div>
                        </div>
                        <div class="h-64 sm:h-96 bg-slate-900 flex items-center justify-center">
                            <p class="text-slate-600 text-sm font-mono">[ Interactive Dashboard Preview ]</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-layouts.app>
