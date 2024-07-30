<x-app-layout>
    <form method="POST" action="{{ route('account.store') }}">
        @csrf

        <!-- Type -->
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-input-label for="type" class="max-w-7xl mx-auto sm:px-6 lg:px-8">Account Type</x-input-label>
            <select id="type" name="type" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option value="" disabled selected>Choose Account Type</option>
                <option value="investing">Investment Account</option>
                <option value="checking">Checking Account</option>
            </select>
        </div>

        <!-- Currency -->
        <div class="mt-4 max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-input-label for="currency" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Currency</x-input-label>
            <select id="currency" name="currency" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option value="" disabled selected>Choose Currency</option>
                <option value="eur">EUR</option>
                @foreach($currencies as $currency)
                    <option value="{{ $currency->getSymbol() }}">{{ strtoupper($currency->getSymbol() ) }}</option>
                @endforeach
            </select>
        </div>

        <!-- Starting Amount -->
        <div class="mt-4 max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-input-label for="starting_amount" :value="__('Enter amount of money to deposit')" />
            <x-text-input id="starting_amount" name="starting_amount" class="block mt-1 w-full" type="number" step="0.01" required autocomplete="starting_amount" />
            <x-input-error :messages="$errors->get('starting_amount')" class="mt-2" />
        </div>

        <div class="mt-4 max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-primary-button>
                {{ __('Create Account') }}
            </x-primary-button>
        </div>
    </form>
</x-app-layout>
