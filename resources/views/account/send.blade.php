<x-app-layout>

    <form method="POST" class="max-w-sm mx-auto" action="/transfer">
        @csrf
        <div class="mt-4 max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-input-label for="recipientAccount" :value="__('Enter recipients account number')" />
            <x-text-input id="recipientAccount" name="recipientAccount" class="block mt-1 w-full" type="text" step="0.01" required autocomplete="recipientAccount" />
            <x-input-error :messages="$errors->get('recipientAccount')" class="mt-2" />
        </div>
        <div class="mt-4 max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-input-label for="transferAccount" >Transfer account</x-input-label>
            <select id="transferAccount" name="transferAccount" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option value="" disabled selected>Choose Account from which to send</option>
                @foreach($accounts as $account)
                    <option value="{{ $account->account_number }}">{{ $account->account_number }}</option>
                @endforeach
            </select>
        </div>
        <div class="mt-4 max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-input-label for="amount" :value="__('Enter amount of money to deposit')" />
            <x-text-input id="amount" name="amount" class="block mt-1 w-full" type="number" step="0.01" required autocomplete="amount" />
            <x-input-error :messages="$errors->get('amount')" class="mt-2" />
        </div>
        <div class="mt-4 max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-primary-button>
                {{ __('Transfer funds') }}
            </x-primary-button>
        </div>
    </form>
</x-app-layout>
