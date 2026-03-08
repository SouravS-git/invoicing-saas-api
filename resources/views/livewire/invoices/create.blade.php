<div class="bg-gray-50 min-h-screen">
    <div class="bg-white border-b border-gray-200 py-2">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-3">
            <nav class="flex text-xs font-medium text-gray-500 items-center gap-2">
                <a wire:navigate href="{{ route('dashboard') }}" class="hover:text-emerald-600 transition">Dashboard</a>
                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
                <a wire:navigate href="{{ route('invoices.index') }}"
                   class="hover:text-emerald-600 transition">Invoices</a>
                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
                <span class="text-gray-900 font-semibold">Create</span>
            </nav>
        </div>
    </div>

    {{--TODO: Need to show in a toaster--}}
    @error('error')
    <div class="alert alert-danger">
        {{ $message }}
    </div>
    @enderror

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">

        <div class="mb-10 flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight">New Invoice</h1>
                <p class="text-sm text-gray-500 mt-1 font-medium">Capture customer and billing details to generate a
                    record.</p>
            </div>
            <a wire:navigate href="{{ route('invoices.index') }}"
               class="inline-flex items-center text-sm font-bold text-emerald-600 hover:text-emerald-500 transition-colors">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/>
                </svg>
                Back to Invoices
            </a>
        </div>

        <form wire:submit="store" method="POST">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                <div class="lg:col-span-2 space-y-6">
                    <div class="bg-white border border-gray-200 rounded-2xl shadow-sm p-8">
                        <h3 class="text-sm font-black uppercase tracking-widest text-emerald-600 mb-6">Customer
                            Information</h3>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="md:col-span-2">
                                <label class="block text-xs font-bold text-gray-500 uppercase mb-2">Customer
                                    Name</label>
                                <input
                                    type="text"
                                    wire:model="form.customer_name"
                                    placeholder="Enter full name"
                                    class="w-full border border-gray-300 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 outline-none transition"
                                >
                                @error('form.customer_name')
                                <p class="mt-1.5 text-xs text-rose-600 font-bold flex items-center gap-1">
                                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                              d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-5a.75.75 0 01.75.75v4.5a.75.75 0 01-1.5 0v-4.5A.75.75 0 0110 5zm0 10a1 1 0 100-2 1 1 0 000 2z"
                                              clip-rule="evenodd"/>
                                    </svg>
                                    {{ $message }}
                                </p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-xs font-bold text-gray-500 uppercase mb-2">Email
                                    Address</label>
                                <input
                                    type="email"
                                    wire:model="form.customer_email"
                                    placeholder="name@company.com"
                                    class="w-full border border-gray-300 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 outline-none transition"
                                >
                                @error('form.customer_email')
                                <p class="mt-1.5 text-xs text-rose-600 font-bold flex items-center gap-1">
                                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                              d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-5a.75.75 0 01.75.75v4.5a.75.75 0 01-1.5 0v-4.5A.75.75 0 0110 5zm0 10a1 1 0 100-2 1 1 0 000 2z"
                                              clip-rule="evenodd"/>
                                    </svg>
                                    {{ $message }}
                                </p>
                                @enderror
                            </div>

                            <div>
                                <label for="customer_phone"
                                       class="block text-xs font-bold text-gray-500 uppercase mb-2">
                                    Phone Number
                                </label>
                                <div class="relative group">
                                    <div
                                        class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none border-r border-gray-200 pr-3 my-2">
                                        <span class="text-sm font-bold text-slate-400">+91</span>
                                    </div>

                                    <input
                                        type="tel"
                                        wire:model="form.customer_phone"
                                        placeholder="XXXXXXXXXX"
                                        class="w-full bg-white border border-gray-300 rounded-xl pl-16 pr-4 py-3 text-sm font-medium focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 outline-none transition shadow-sm"
                                        pattern="[0-9]{10}"
                                        maxlength="10"
                                    >
                                    @error('form.customer_phone')
                                    <p class="mt-1.5 text-xs text-rose-600 font-bold flex items-center gap-1">
                                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                  d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-5a.75.75 0 01.75.75v4.5a.75.75 0 01-1.5 0v-4.5A.75.75 0 0110 5zm0 10a1 1 0 100-2 1 1 0 000 2z"
                                                  clip-rule="evenodd"/>
                                        </svg>
                                        {{ $message }}
                                    </p>
                                    @enderror
                                </div>
                                <p class="mt-1.5 text-[10px] text-gray-400 font-medium italic">Enter 10-digit mobile
                                    number</p>
                            </div>

                            <div class="md:col-span-2">
                                <label class="block text-xs font-bold text-gray-500 uppercase mb-2">Billing
                                    Address</label>
                                <textarea
                                    wire:model="form.billing_address"
                                    placeholder="Street, City, State, ZIP"
                                    class="w-full border border-gray-300 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 outline-none transition"
                                    rows="3"
                                ></textarea>
                                @error('form.billing_address')
                                <p class="mt-1.5 text-xs text-rose-600 font-bold flex items-center gap-1">
                                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                              d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-5a.75.75 0 01.75.75v4.5a.75.75 0 01-1.5 0v-4.5A.75.75 0 0110 5zm0 10a1 1 0 100-2 1 1 0 000 2z"
                                              clip-rule="evenodd"/>
                                    </svg>
                                    {{ $message }}
                                </p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="bg-white border border-gray-200 rounded-2xl shadow-sm p-8">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-xs font-bold uppercase mb-2 text-emerald-600">Invoice
                                    Date</label>
                                <input
                                    type="date"
                                    wire:model="form.invoice_date"
                                    class="w-full border border-gray-300 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 outline-none transition"
                                >
                                @error('form.invoice_date')
                                <p class="mt-1.5 text-xs text-rose-600 font-bold flex items-center gap-1">
                                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                              d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-5a.75.75 0 01.75.75v4.5a.75.75 0 01-1.5 0v-4.5A.75.75 0 0110 5zm0 10a1 1 0 100-2 1 1 0 000 2z"
                                              clip-rule="evenodd"/>
                                    </svg>
                                    {{ $message }}
                                </p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-xs font-bold uppercase mb-2 text-emerald-600">Payment
                                    Method</label>
                                <select
                                    wire:model="form.payment_method"
                                    class="w-full border border-gray-300 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 outline-none transition"
                                >
                                    <option value="">Select</option>
                                    <option value="Bank Transfer">Bank Transfer</option>
                                    <option value="UPI">UPI / Digital Wallet</option>
                                    <option value="Credit Card">Credit Card</option>
                                    <option value="Cash">Cash</option>
                                </select>
                                @error('form.payment_method')
                                <p class="mt-1.5 text-xs text-rose-600 font-bold flex items-center gap-1">
                                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                              d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-5a.75.75 0 01.75.75v4.5a.75.75 0 01-1.5 0v-4.5A.75.75 0 0110 5zm0 10a1 1 0 100-2 1 1 0 000 2z"
                                              clip-rule="evenodd"/>
                                    </svg>
                                    {{ $message }}
                                </p>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <div class="space-y-6">
                    <div class="bg-emerald-600 rounded-2xl shadow-xl shadow-emerald-900/10 p-8 text-white">
                        <h3 class="text-xs font-black uppercase tracking-widest opacity-80 mb-6">Settlement Summary</h3>

                        <div class="space-y-6">
                            <div>
                                <label class="block text-xs font-bold uppercase mb-2">Status</label>
                                <select
                                    wire:model="form.status"
                                    class="w-full bg-emerald-700/50 border border-emerald-400/30 rounded-xl px-4 py-3 text-sm font-bold focus:ring-2 focus:ring-white/20 outline-none transition appearance-none cursor-pointer"
                                >
                                    @foreach(\App\Enums\InvoiceStatus::cases() as $status)
                                        <option value="{{ $status->value }}"
                                                class="text-gray-900">{{ $status->label() }}</option>
                                    @endforeach
                                </select>
                                @error('form.status')
                                <p class="mt-1.5 text-xs text-rose-600 font-bold flex items-center gap-1">
                                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                              d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-5a.75.75 0 01.75.75v4.5a.75.75 0 01-1.5 0v-4.5A.75.75 0 0110 5zm0 10a1 1 0 100-2 1 1 0 000 2z"
                                              clip-rule="evenodd"/>
                                    </svg>
                                    {{ $message }}
                                </p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-xs font-bold uppercase mb-2">Total Amount (₹)</label>
                                <div class="relative">
                                    <span
                                        class="absolute inset-y-0 left-0 pl-4 flex items-center font-bold text-emerald-200">₹</span>
                                    <input
                                        type="number"
                                        wire:model="form.total_amount"
                                        placeholder="0.00"
                                        class="w-full bg-emerald-700 border border-emerald-400/30 rounded-xl pl-10 pr-4 py-4 text-2xl font-black placeholder-emerald-300/50 focus:ring-2 focus:ring-white/20 outline-none transition"
                                        step="0.01"
                                    >
                                    @error('form.total_amount')
                                    <p class="mt-1.5 text-xs text-rose-600 font-bold flex items-center gap-1">
                                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                  d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-5a.75.75 0 01.75.75v4.5a.75.75 0 01-1.5 0v-4.5A.75.75 0 0110 5zm0 10a1 1 0 100-2 1 1 0 000 2z"
                                                  clip-rule="evenodd"/>
                                        </svg>
                                        {{ $message }}
                                    </p>
                                    @enderror
                                </div>
                            </div>

                            <div class="pt-4">
                                <button type="submit"
                                        class="cursor-pointer w-full bg-white text-emerald-700 font-black py-4 rounded-xl shadow-lg hover:bg-emerald-50 hover:-translate-y-1 transition-all active:scale-95 text-center uppercase tracking-widest text-xs">
                                    Finalize & Save
                                </button>
                                <p class="text-[10px] text-center mt-4 opacity-60 font-medium italic">All data will be
                                    isolated to your business.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </main>
</div>
