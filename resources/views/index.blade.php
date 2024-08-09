<x-app-layout>
    <div class="container mx-auto p-4">
        <div class="flex space-x-4">
            <!-- First Table -->
            <div class="w-1/2 bg-white p-4 rounded-lg shadow-lg">
                <h2 class="text-xl font-bold mb-4">Checking Account</h2>
                @if($checking->isEmpty())
                    <div class="text-center bg-white p-6 rounded-lg shadow-md">
                        <p class="text-gray-700 text-lg font-semibold mb-4">Looks like you don't have any checking accounts here. Would you like to create one?</p>
                        <a href="{{ route('account.create') }}" class="inline-block bg-blue-600 text-white py-2 px-4 rounded hover:bg-blue-500 transition">
                            Create Account
                        </a>
                    </div>
                @else
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 sm:rounded-lg">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Account Number
                            </th>

                            <th scope="col" class="px-6 py-3">
                                Currency
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Balance
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Action
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($checking as $account)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $account->account_number }}
                                </th>
                                <td class="px-6 py-4">
                                    {{ strtoupper($account->currency) }}
                                </td>

                                <td class="px-6 py-4">
                                    {{ number_format($account->amount_now,2) }}
                                </td>
                                <td class="px-6 py-4">
                                    <a href="/checking/{{$account->id}}">
                                        View
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @endif
            </div>

            <!-- Second Table -->
            <div class="w-1/2 bg-white p-4 rounded-lg shadow-lg">
                <h2 class="text-xl font-bold mb-4">Investment Accounts</h2>
                @if($investment->isEmpty())
                    <div class="text-center bg-white p-6 rounded-lg shadow-md">
                        <p class="text-gray-700 text-lg font-semibold mb-4">Looks like you don't have any investment accounts here. Would you like to create one?</p>
                        <a href="{{ route('account.create') }}" class="inline-block bg-blue-600 text-white py-2 px-4 rounded hover:bg-blue-500 transition">
                            Create Account
                        </a>
                    </div>
                @else
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 sm:rounded-lg">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Account Number
                            </th>

                            <th scope="col" class="px-6 py-3">
                                Currency
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Balance
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Action
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($investment as $account)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $account->account_number }}
                                </th>
                                <td class="px-6 py-4">
                                    {{ strtoupper($account->currency) }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ number_format($account->amount_now,2) }}
                                </td>
                                <td class="px-6 py-4">
                                    <a href="/investing/{{$account->id}}">
                                        View
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
