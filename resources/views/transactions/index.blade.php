<x-app-layout>
    <div class="py-12 relative overflow-x-auto">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 sm:rounded-lg">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Account Number
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Type
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Currency
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Amount
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Date
                    </th>
                </tr>
                </thead>
                <tbody>
                @foreach($transactions as $transaction)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $transaction->account_number }}
                        </th>
                        <td class="px-6 py-4">
                            {{ $transaction->type }}
                        </td>
                        <td class="px-6 py-4">
                            {{ strtoupper($transaction->currency) }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $transaction->amount }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $transaction->created_at }}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="mt-4">
                {{ $transactions->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
