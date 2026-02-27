<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="max-w-md mx-auto">

        <div class="bg-white border border-gray-200 rounded-2xl shadow-sm overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-100 bg-gray-50/50">
                <h3 class="text-lg font-bold text-gray-900">Create Invoice</h3>
                <p class="text-xs text-gray-500">Enter basic invoice details below.</p>
            </div>

            <form wire:submit="save" method="POST" class="p-6 space-y-5">

                <x-form-field label="Invoice Number" name="invoice_number" type="text" placeholder="INV-001" wire:model="invoice_number" />
                <x-form-field label="Amount" type="text" name="total_amount" placeholder="100.00" wire:model="total_amount" />

                <div class="pt-2">
                    <button type="submit" class="w-full bg-emerald-600 hover:bg-emerald-500 text-white font-bold py-2.5 rounded-lg shadow-lg shadow-emerald-900/10 transition-all active:scale-[0.98]">
                        Save Invoice
                    </button>
                </div>
            </form>
        </div>

        <p class="mt-4 text-center">
            <a href="#" class="text-sm font-medium text-gray-400 hover:text-emerald-600 transition-colors">
                Cancel and go back
            </a>
        </p>
    </div>
</div>
