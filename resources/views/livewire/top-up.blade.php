<div>
    <div class="p-6 bg-white border border-gray-200 rounded-lg shadow-sm">
        <h3 class="text-lg font-semibold text-gray-900 mb-4">Recharge Credits</h3>

        @if (session()->has('message'))
            <div class="mb-4 p-3 bg-green-50 text-green-700 rounded-md border border-green-200">
                {{ session('message') }}
            </div>
        @endif

        <div class="flex items-center gap-4">
            <div>
                <label for="amount" class="sr-only">Amount</label>
                <div class="relative rounded-md shadow-sm">
                    <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                        <span class="text-gray-500 sm:text-sm">$</span>
                    </div>
                    <input type="number" wire:model="amount" id="amount"
                           class="block w-full rounded-md border-0 py-1.5 pl-7 pr-12 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6">
                </div>
            </div>

            <button type="button" wire:click="addBalance"
                    class="rounded-md bg-blue-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-blue-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600">
                Buy Credits
            </button>
        </div>

        @error('amount') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
    </div>
</div>
