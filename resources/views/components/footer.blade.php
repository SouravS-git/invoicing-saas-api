<div class="bg-slate-950 text-slate-400 py-6 border-t border-slate-900">
    <div class="max-w-7xl mx-auto px-4 flex flex-col md:flex-row justify-between items-center gap-4">
        <div class="text-xs">
            &copy; {{ now()->year }} {{ config('app.name', 'Laravel') }}
        </div>

        <div class="flex space-x-6 text-xs font-medium">
            <a href="#" class="hover:text-emerald-400 transition">Privacy</a>
            <a href="#" class="hover:text-emerald-400 transition">Terms</a>
            <a href="#" class="hover:text-emerald-400 transition">Support</a>
        </div>
    </div>
</div>
