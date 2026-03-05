<div class="bg-gray-50 min-h-screen">
    <div class="bg-white border-b border-gray-200 py-2">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-3">
            <nav class="flex text-xs font-medium text-gray-500 items-center gap-2">
                <a wire:navigate href="{{ route('dashboard') }}" class="hover:text-emerald-600 transition">Dashboard</a>
                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
                <span class="text-gray-900 font-semibold">Credits</span>
            </nav>
        </div>
    </div>

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
        <div class="mb-10 flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight">Credit Balance</h1>
                <p class="text-sm text-gray-500 mt-1 font-medium">Add funds to your workspace to continue using premium features.</p>
            </div>
        </div>

        <div class="bg-white border border-gray-200 rounded-2xl shadow-sm overflow-hidden mb-4 p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 p-6">
                <div class="bg-white border border-gray-200 rounded-2xl p-6 flex flex-col justify-center">
                    <span class="text-xs font-bold text-gray-400 uppercase tracking-wider">Available Balance</span>
                    <div class="mt-2 flex items-baseline gap-1">
                        <span class="text-2xl font-bold text-gray-900">₹</span>
                        <span class="text-4xl font-black text-gray-900 tracking-tight">{{ $balance }}</span>
                    </div>
                    <div class="mt-4 flex items-center gap-2 text-[10px] font-bold text-emerald-600 bg-emerald-50 px-2 py-1 rounded w-fit">
                        <span class="relative flex h-2 w-2">
                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-2 w-2 bg-emerald-500"></span>
                        </span>
                        ACTIVE WALLET
                    </div>
                </div>

                <div class="bg-white border border-gray-200 rounded-2xl p-6 shadow-sm">
                    <form wire:submit="initiatePayment" method="POST" class="space-y-4">
                        <div>
                            <label for="customer_phone" class="block text-xs font-bold text-gray-500 uppercase mb-2">
                                Enter Amount
                            </label>
                            <div class="relative group">
                                <input
                                    type="number"
                                    wire:model="amount"
                                    class="w-full bg-white border border-gray-300 rounded-xl pl-4 pr-4 py-3 text-sm font-medium focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 outline-none transition shadow-sm"
                                    min="10"
                                >
                                @error('amount')
                                <p class="mt-1.5 text-xs text-rose-600 font-bold flex items-center gap-1">
                                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-5a.75.75 0 01.75.75v4.5a.75.75 0 01-1.5 0v-4.5A.75.75 0 0110 5zm0 10a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd"/></svg>
                                    {{ $message }}
                                </p>
                                @enderror
                            </div>
                            <p class="mt-1.5 text-[10px] text-gray-400 font-medium italic">Minimum amount Rs. 10</p>
                        </div>

                        <button wire:loading.attr="disabled" type="submit" class="cursor-pointer w-full bg-emerald-600 hover:bg-emerald-700 text-white font-bold py-2.5 rounded-lg transition-all active:scale-[0.98] shadow-md shadow-emerald-900/10">
                            <span wire:loading.remove>Make Payment</span>
                            <span wire:loading>Please wait...</span>
                        </button>

                        <p class="text-[10px] text-center text-gray-400 uppercase tracking-tighter">
                            Secure payment via Razorpay
                        </p>
                    </form>
                </div>
            </div>

            <div class="mt-10 mb-10 bg-white border border-gray-200 rounded-2xl overflow-hidden shadow-sm">
                <div class="px-6 py-4 border-b border-gray-100 bg-gray-50/50">
                    <h3 class="text-sm font-bold text-gray-900">Recent Top-ups</h3>
                </div>

                <table class="w-full text-left">
                    <tbody class="divide-y divide-gray-100">
                    @foreach($transactions as $transaction)
                    <tr wire:key="{{ $transaction->id }}">
                        <td class="px-6 py-3 text-xs font-medium text-gray-600">{{ $transaction->created_at->format('d/m/Y H:i:s') }}</td>
                        <td class="px-6 py-3 text-xs font-bold text-emerald-600">Rs. +{{ $transaction->amount }}</td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            {{ $transactions->links() }}
        </div>
    </main>
</div>

<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
    document.addEventListener('livewire:init', () => {
        Livewire.on('open-checkout', (event) => {
            var options = event[0];

            options.handler = function (response) {
                Livewire.dispatch('verify-payment', {
                    'response': response
                });
            }

            var rzp = new Razorpay(options);
            rzp.open();
        })
    });
</script>
