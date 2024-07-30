<x-app-layout>

    <form method="POST" action="/investing/{{$id}}">
        @csrf
        <div class="mt-4 max-w-7xl mx-auto sm:px-6 lg:px-8">

            <h2 class="text-base font-semibold leading-7 text-gray-900">Buy Crypto</h2>
        </div>


        <!-- Currency -->
        <div class="mt-4 max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-input-label for="currency" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Currency</x-input-label>
            <select id="currency" name="currency" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option value="" disabled selected>Choose Currency</option>
                @foreach($cryptos as $crypto)
                    <option value="{{ $crypto->getSymbol() }}">{{ strtoupper($crypto->getSymbol() ) }}</option>
                @endforeach
            </select>
        </div>

        <!-- Starting Amount -->
        <div class="mt-4 max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-input-label for="purchase_price" :value="__('Enter purchase amount in USD')" />
            <x-text-input id="purchase_price" name="purchase_price" class="block mt-1 w-full" type="number" step="0.01" required autocomplete="purchase_price" />
            <x-input-error :messages="$errors->get('purchase_price')" class="mt-2" />
        </div>

        <div class="mt-4 max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-primary-button>
                {{ __('Buy crypto') }}
            </x-primary-button>
        </div>
    </form>
</x-app-layout>
