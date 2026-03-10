<div class="bg-gray-50 min-h-screen">
    <div class="bg-white border-b border-gray-200 py-2">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-3">
            <nav class="flex text-xs font-medium text-gray-500 items-center gap-2">
                <a wire:navigate href="{{ route('dashboard') }}" class="hover:text-emerald-600 transition">Dashboard</a>
                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
                <span class="text-gray-900 font-semibold">Invoices</span>
            </nav>
        </div>
    </div>

    {{--TODO: Need to show in a toaster--}}
    @session('success')
        {{ session('success') }}
    @endsession

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">

        <div class="mb-10 flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight">Invoices</h1>
                <p class="text-sm text-gray-500 mt-1 font-medium">Manage billing for your business.</p>
            </div>
            <a wire:navigate href="{{ route('invoices.create') }}" class="inline-flex items-center justify-center rounded-lg bg-emerald-600 px-5 py-2.5 text-sm font-bold text-white shadow-lg shadow-emerald-900/10 hover:bg-emerald-500 hover:-translate-y-0.5 transition-all active:scale-95">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Create New Invoice
            </a>
        </div>

        <div class="mb-6 flex flex-col md:flex-row items-center gap-4 bg-white border border-gray-200 rounded-2xl p-4 shadow-sm">

            <div class="relative grow w-full md:w-auto">
                <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </span>
                <input wire:model.live.debounce.300ms="searchQuery" type="text" placeholder="Search by invoice number or customer name..." class="block w-full pl-10 pr-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 outline-none transition-all">
            </div>

            <div class="flex flex-wrap items-center gap-3 w-full md:w-auto">
                <div class="w-full md:w-40">
                    <select wire:model.live="status" class="block w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm text-gray-600 focus:ring-2 focus:ring-emerald-500/20 outline-none cursor-pointer">
                        <option value="*">All Statuses</option>
                        @foreach(\App\Enums\InvoiceStatus::cases() as $status)
                            <option value="{{ $status->value }}">{{ $status->label() }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="w-full md:w-48">
                    <select wire:model.live="period" class="block w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm text-gray-600 focus:ring-2 focus:ring-emerald-500/20 outline-none cursor-pointer">
                        <option value="*">Anytime</option>
                        <option value="today">Today</option>
                        <option value="this_week">This Week</option>
                        <option value="this_month">This Month</option>
                        <option value="this_year">This Year</option>
                    </select>
                </div>

                <button wire:click="clearFilters" class="cursor-pointer text-xs font-bold text-gray-400 hover:text-rose-500 transition-colors uppercase tracking-widest">
                    Clear Filters
                </button>
            </div>
        </div>

        <div class="bg-white border border-gray-200 rounded-2xl shadow-sm overflow-hidden mb-4">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                    <tr class="bg-gray-50/50 border-b border-gray-200">
                        <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-gray-500">Invoice Number</th>
                        <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-gray-500">Customer</th>
                        <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-gray-500">Contact</th>
                        <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-gray-500">Amount</th>
                        <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-gray-500">Status</th>
                        {{--<th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-gray-500 text-right">Action</th>--}}
                    </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                    @forelse($invoices as $invoice)
                    <tr wire:key="{{ $invoice->id }}" class="hover:bg-slate-50/80 transition-colors group">
                        <td class="px-6 py-4">
                            <span class="text-sm font-bold text-gray-900 group-hover:text-emerald-600 transition-colors">{{ $invoice->invoice_number }}</span>
                            <p class="text-xs text-gray-400">Issued On: {{ $invoice->invoice_date }}</p>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <span class="text-sm font-medium text-gray-700">{{ $invoice->customer_name }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="text-sm font-bold text-gray-900 group-hover:text-emerald-600 transition-colors">{{ $invoice->billing_address }}</span>
                            <p class="text-xs text-gray-400">Phone - {{ $invoice->customer_phone }}</p>
                            <p class="text-xs text-gray-400">Email - {{ $invoice->customer_email }}</p>
                        </td>
                        <td class="px-6 py-4">
                            <span class="text-sm font-bold text-gray-900 group-hover:text-emerald-600 transition-colors">₹{{ $invoice->total_amount }}</span>
                            <p class="text-xs text-gray-400">Payment Mode - {{ $invoice->payment_method }}</p>
                        </td>
                        <td class="px-6 py-4">
                            @if($invoice->status->value === 'due')
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-red-100 text-red-700 border border-red-200">
                                    <span class="w-1.5 h-1.5 rounded-full bg-red-500 mr-1.5 animate-pulse"></span>
                                    {{ $invoice->status->label() }}
                                </span>
                            @elseif($invoice->status->value === 'paid')
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-emerald-100 text-emerald-700 border border-emerald-200">
                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 mr-1.5 animate-pulse"></span>
                                    {{ $invoice->status->label() }}
                                </span>
                            @endif
                        </td>
                        {{--<td class="px-6 py-4 text-right">
                            <button class="p-2 text-gray-400 hover:text-emerald-600 transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                            </button>
                            <button class="p-2 text-gray-400 hover:text-emerald-600 transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                            </button>
                        </td>--}}
                    </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="py-4 text-center">No Invoices</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        {{ $invoices->links() }}
    </main>
</div>
