<x-app-layout>
    <div class="max-w-2xl mx-auto">
        <div class="bg-white rounded-xl shadow-sm p-6">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">Pay for Meals</h2>

            <div class="grid md:grid-cols-2 gap-6 mb-6">
                <div class="rounded-lg border p-4">
                    <div class="text-sm text-gray-500">Current Balance</div>
                    <div class="text-2xl font-bold">{{ number_format($foodTaken->payment_amount ?? 0) }} RWF</div>
                </div>
                <div class="rounded-lg border p-4">
                    <div class="text-sm text-gray-500">Meals Remaining</div>
                    <div class="text-2xl font-bold">{{ $foodTaken->times_remaining ?? 0 }}</div>
                </div>
            </div>

            <form method="POST" action="{{ route('take-food.payment.process') }}" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-sm font-medium text-gray-700">Amount (RWF)</label>
                    <input type="number" min="1000" step="100" name="amount" required class="mt-1 w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500" placeholder="e.g. 5000" />
                    <p class="text-xs text-gray-500 mt-1">Each meal costs {{ number_format($foodTaken->meal_cost ?? 1000) }} RWF.</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Payment Method</label>
                    <select name="payment_method" class="mt-1 w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                        <option value="mobile_money">Mobile Money</option>
                        <option value="bank_transfer">Bank Transfer</option>
                        <option value="cash">Cash</option>
                    </select>
                </div>
                <div class="pt-2">
                    <button type="submit" class="inline-flex items-center px-4 py-2 rounded-md bg-blue-600 text-white hover:bg-blue-700">Pay</button>
                    <a href="{{ route('take-food') }}" class="ml-3 inline-flex items-center px-4 py-2 rounded-md bg-gray-100 text-gray-700 hover:bg-gray-200">Back</a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>


