<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Home Page') }}
        </h2>
    </x-slot>
    <div class="py-12 relative overflow-x-auto">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if($accounts->isEmpty())
                <p>Looks like you don't have any accounts here. Would you like to create one?</p>
                <a href="{{ route('account.create') }}" class="btn btn-primary">Create Account</a>
            @else
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
                            Balance
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Action
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($accounts as $account)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $account->account_number }}
                            </th>
                            <td class="px-6 py-4">
                                {{ strtoupper($account->currency) }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $account->type }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $account->amount_now }}
                            </td>
                            <td class="px-6 py-4">
                                <a href="/investing/{{ $account->id}}">
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

</x-app-layout>
