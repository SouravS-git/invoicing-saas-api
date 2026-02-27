<div class="py-12">
    <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white p-6 shadow sm:rounded-lg">
            <h2 class="text-xl font-bold mb-6">Create New Invoice</h2>

            @foreach ($errors->all() as $error)
                <div class="mb-4 p-3 bg-red-100 text-red-700 rounded-md border border-red-200">
                    {{ $error }}
                    <a href="{{ route('billing') }}" class="underline font-bold">Top up here</a>
                </div>
            @endforeach

            <form wire:submit="save" class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Invoice Number</label>
                    <input type="text" wire:model="invoice_number" class="w-full border-gray-300 rounded-md mt-1">
                    @error('invoice_number') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Total Amount ($)</label>
                    <input type="number" wire:model="total_amount" class="w-full border-gray-300 rounded-md mt-1">
                    @error('total_amount') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>

                <div class="pt-4 flex items-center justify-between">
                    <span class="text-sm text-gray-500">Cost: 1.00 Credit</span>
                    <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-md hover:bg-blue-700">
                        Create & Pay 1 Credit
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
