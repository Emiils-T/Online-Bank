<x-app-layout>


    <main class="h-full overflow-y-auto">
        <div class="container px-6 mx-auto grid">
            <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
                Investing Dashboard
            </h2>
            <!-- CTA -->

            <!-- Cards -->
            <div class="grid gap-6 mb-8 md:grid-cols-2 xl:grid-cols-4">
                <!-- Card -->
                <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                    <div
                        class="p-3 mr-4 text-orange-500 bg-orange-100 rounded-full dark:text-orange-100 dark:bg-orange-500">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                            Profit
                        </p>
                        <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                            @php

                                $totalInitialValue = $cryptoWallet->sum('value');
                                $totalCurrentValue = $cryptoWallet->sum('value_now');


                                $profit = $totalCurrentValue - $totalInitialValue;
                            @endphp
                            @if($profit > 0)
                                <span style="color: green;">&#9650; {{ number_format($profit, 2) }}</span>
                            @else
                                <span style="color: red;">&#9660; {{ number_format(abs($profit), 2) }}</span>
                            @endif
                        </p>
                    </div>
                </div>
                <!-- Card -->
                <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                    <div
                        class="p-3 mr-4 text-green-500 bg-green-100 rounded-full dark:text-green-100 dark:bg-green-500">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                  d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z"
                                  clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                            Account balance
                        </p>
                        <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                            $ {{ number_format($account->amount_now,5) }}
                        </p>
                    </div>
                </div>
                <!-- Card -->
                <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                    <div class="p-3 mr-4 text-blue-500 bg-blue-100 rounded-full dark:text-blue-100 dark:bg-blue-500">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3zM16 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM6.5 18a1.5 1.5 0 100-3 1.5 1.5 0 000 3z"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                            Crypto Total Value
                        </p>
                        <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                            $ {{number_format($cryptoSum ,2)}}
                        </p>
                    </div>
                </div>
                <!-- Card -->
                <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                    <div
                        class="p-1 mr-2 text-green-500 bg-green-200 rounded-full dark:text-green-100 dark:bg-green-500">
                        <x-crypto-logo alt="Bitcoin_Logo" class="w-9 h-9"/>
                    </div>
                    <div>
                        <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                            Bought Cryptos
                        </p>
                        <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                            {{$cryptoWallet->count()}}
                        </p>
                    </div>
                </div>
            </div>

            <!-- New Table -->
            <div class="w-full overflow-hidden rounded-lg shadow-xs">
                <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
                    Crypto portfolio
                </h2>
                <div class="w-full overflow-x-auto">
                    <table class="w-full whitespace-no-wrap">
                        <thead>
                        <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                            <th class="px-4 py-3">Symbol</th>
                            <th class="px-4 py-3">Amount</th>
                            <th class="px-4 py-3">Value at purchase</th>
                            <th class="px-4 py-3">Value now</th>
                            <th class="px-4 py-3">Crypto price</th>
                            <th class="px-4 py-3">Action</th>
                        </tr>
                        </thead>
                        <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                        @foreach($cryptoWallet as $walletCoin)
                            <tr>
                                <td class="px-4 py-3 text-sm"><img src="{{$walletCoin['logo']}}" alt="{{ $walletCoin['symbol'] }} logo" class="inline-block h-6 w-6 mr-2" > {{ $walletCoin->symbol }}</td>
                                <td class="px-4 py-3 text-sm">{{ number_format($walletCoin['amount'],5)  }}</td>
                                <td class="px-4 py-3 text-sm">$ {{ $walletCoin["value"] }}</td>
                                <td class="px-4 py-3 text-sm">
                                    @if($walletCoin->value <= $walletCoin->value_now )
                                        <span
                                            style="color: green;">&#9650; $ {{ number_format($walletCoin['value_now'],5) }}</span>
                                    @else
                                        <span
                                            style="color: red;">&#9660; $ {{ number_format($walletCoin['value_now'],5) }}</span>
                                    @endif
                                </td>

                                <td class="px-4 py-3 text-sm">$ {{  number_format($walletCoin['price'],2) }}</td>
                                <td class="px-4 py-3 text-sm">
                                    <form method="POST" action="/investing/{{$account->id}}/sell/{{ $walletCoin['symbol'] }}">
                                        @csrf
                                        <button data-modal-target="#sellModal{{$walletCoin['symbol']}}"
                                                data-modal-toggle="#sellModal{{$walletCoin['symbol']}}"
                                                class="block text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                                                type="button">
                                            Sell
                                        </button>
                                    </form>
                                    <div id="#sellModal{{$walletCoin['symbol']}}" tabindex="-1" aria-hidden="true"
                                         class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                        <div class="relative p-4 w-full max-w-md max-h-full">
                                            <!-- Modal content -->
                                            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                                <!-- Modal header -->
                                                <div
                                                    class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                                        Sell Crypto
                                                    </h3>
                                                    <button type="button"
                                                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                                            data-modal-toggle="#sellModal{{$walletCoin['symbol']}}">
                                                        <svg class="w-3 h-3" aria-hidden="true"
                                                             xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                            <path stroke="currentColor" stroke-linecap="round"
                                                                  stroke-linejoin="round" stroke-width="2"
                                                                  d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                                        </svg>
                                                        <span class="sr-only">Close modal</span>
                                                    </button>
                                                </div>
                                                <!-- Modal body -->
                                                <form method="POST" action="/investing/{{$account->id}}/sell/{{ $walletCoin['symbol'] }}"
                                                      class="p-4 md:p-5 bg-white rounded-lg shadow dark:bg-gray-800">
                                                    @csrf
                                                    <div class="grid gap-4 mb-4 grid-cols-2">
                                                        <!-- Display the cryptocurrency symbol -->
                                                        <div class="col-span-2">
                                                            <label for="symbol"
                                                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Symbol</label>
                                                            <input type="text" id="symbol" value="{{ $walletCoin['symbol'] }}"
                                                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                                                   readonly>
                                                        </div>

                                                        <!-- Input field for the amount to sell -->
                                                        <div class="col-span-2">
                                                            <label for="amount"
                                                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Amount
                                                                to Sell</label>
                                                            <input type="number" name="amount" id="amount"
                                                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-green-500 dark:focus:border-green-500"
                                                                   placeholder="Enter amount to sell" step="0.00000000000000001" required
                                                                   max="{{ $walletCoin['amount'] }}"
                                                            oninput="validateAmount(this)">
                                                            <input type="hidden" name="price" value="{{ $walletCoin['price'] }}">
                                                            <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
                                                                Available amount to sell: {{ $walletCoin['amount'] }}
                                                            </p>
                                                        </div>
                                                    </div>

                                                    <button type="submit"
                                                            class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                                                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20"
                                                             xmlns="http://www.w3.org/2000/svg">
                                                            <path fill-rule="evenodd"
                                                                  d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                                                                  clip-rule="evenodd"></path>
                                                        </svg>
                                                        Sell Crypto
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <!-- Add more columns as needed -->
                            </tr>
                        @endforeach
                        </tbody>


                    </table>
                    <div class="mt-4">
                        {{ $cryptoWallet->links() }}
                    </div>
                </div>


                <div class="max-w-4xl mx-auto p-6 bg-white rounded-lg shadow-lg dark:bg-gray-800">
                    <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-200 mb-6">
                        Crypto Wallet Holdings
                    </h2>

                    <div class="flex flex-col md:flex-row">
                        <div class="w-full md:w-2/3 mb-6 md:mb-0">
                            <div class="chart-container" style="position: relative; height: 300px;">
                                <canvas id="pieChart"></canvas>
                            </div>
                        </div>

                        <div class="w-full md:w-1/3 md:pl-6">
                            <div class="bg-gray-100 dark:bg-gray-700 rounded-lg p-4">
                                <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-300 mb-3">
                                    Holdings Breakdown
                                </h3>
                                <div id="legend" class="space-y-2"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <div class="container mx-auto mt-8 px-4 sm:px-6 lg:px-8">
        <h1 class="text-2xl font-bold text-gray-800 mb-4">Cryptos</h1>

        <!-- Search Bar -->
        <div class="mb-4">
            <input
                type="text"
                id="searchInput"
                class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                placeholder="Search cryptos..."
            >
        </div>

        <!-- Table -->
        <div class="bg-white shadow-lg rounded-lg overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200" id="cryptoTable">
                <thead class="bg-gray-800 text-white">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Name</th>
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Symbol</th>
                    <th class="px-6 py-3 text-right text-xs font-medium uppercase tracking-wider">Price</th>
                    <th class="px-6 py-3 text-right text-xs font-medium uppercase tracking-wider">1H Change</th>
                    <th class="px-6 py-3 text-right text-xs font-medium uppercase tracking-wider">12H Change</th>
                    <th class="px-6 py-3 text-right text-xs font-medium uppercase tracking-wider">24H Change</th>
                    <th class="px-6 py-3 text-right text-xs font-medium uppercase tracking-wider">7D Change</th>
                    <th class="px-6 py-3 text-right text-xs font-medium uppercase tracking-wider">Market Cap</th>
                    <th class="px-6 py-3 text-right text-xs font-medium uppercase tracking-wider">Action</th>
                    <!-- Add more columns as needed -->
                </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                @foreach($cryptos as $crypto)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $crypto["name"] }} </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><img src="{{$crypto['logo']}}" alt="{{ $crypto['symbol'] }} logo" class="inline-block h-6 w-6 mr-2" > {{ $crypto['symbol'] }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-right">{{ $crypto['price'] }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-right">{{ $crypto["1h_change"]}}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-right">{{ $crypto['12h_change']}}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-right">{{ $crypto['24h_change']}}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-right">{{ $crypto['7d_change'] }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-right">{{ $crypto['market_cap'] }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-right">
                            <button data-modal-target="#modal{{$crypto['symbol']}}"
                                    data-modal-toggle="#modal{{$crypto['symbol']}}"
                                    class="block text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                                    type="button">
                                Buy
                            </button>
                            <div id="#modal{{$crypto['symbol']}}" tabindex="-1" aria-hidden="true"
                                 class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                <div class="relative p-4 w-full max-w-md max-h-full">
                                    <!-- Modal content -->
                                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                        <!-- Modal header -->
                                        <div
                                            class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                                Buy Crypto
                                            </h3>
                                            <button type="button"
                                                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                                    data-modal-toggle="#modal{{$crypto['symbol']}}">
                                                <svg class="w-3 h-3" aria-hidden="true"
                                                     xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                    <path stroke="currentColor" stroke-linecap="round"
                                                          stroke-linejoin="round" stroke-width="2"
                                                          d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                                </svg>
                                                <span class="sr-only">Close modal</span>
                                            </button>
                                        </div>
                                        <!-- Modal body -->
                                        <form method="POST" action="/investing/{{$account->id}}/buy/{{ $crypto['symbol'] }}"
                                              class="p-4 md:p-5 bg-white rounded-lg shadow dark:bg-gray-800">
                                            @csrf
                                            <div class="grid gap-4 mb-4 grid-cols-2">
                                                <!-- Display the cryptocurrency symbol -->
                                                <div class="col-span-2">
                                                    <label for="symbol"
                                                           class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Symbol</label>
                                                    <input type="text" id="symbol" value="{{ $crypto['symbol'] }}"
                                                           class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                                           readonly>
                                                </div>

                                                <!-- Input field for the amount to buy -->
                                                <div class="col-span-2">
                                                    <label for="amount"
                                                           class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Amount
                                                        to Buy</label>
                                                    <input type="number" name="purchase_price" id="purchase_price"
                                                           class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-green-500 dark:focus:border-green-500"
                                                           placeholder="Enter amount to buy" min="0.00001"
                                                           step="0.00001" required>
                                                    <input type="hidden" name="price" value="{{ $crypto['price'] }}">
                                                    <input type="hidden" name="name" value="{{ $crypto['name'] }}">
                                                    <input type="hidden" name="logo" value="{{ $crypto['logo'] }}">
                                                </div>
                                            </div>

                                            <button type="submit"
                                                    class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                                                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20"
                                                     xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd"
                                                          d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                                                          clip-rule="evenodd"></path>
                                                </svg>
                                                Buy Crypto
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <!-- Add more columns as needed -->
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div {{$cryptos->links()}} </div>
        </div>





    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const searchInput = document.getElementById('searchInput');
            const table = document.getElementById('cryptoTable');
            const rows = table.getElementsByTagName('tr');



            searchInput.addEventListener('keyup', function () {
                const searchTerm = searchInput.value.toLowerCase();

                for (let i = 1; i < rows.length; i++) {
                    const row = rows[i];
                    const cells = row.getElementsByTagName('td');
                    let found = false;

                    for (let j = 0; j < cells.length; j++) {
                        const cellText = cells[j].textContent.toLowerCase();
                        if (cellText.includes(searchTerm)) {
                            found = true;
                            break;
                        }
                    }

                    row.style.display = found ? '' : 'none';
                }
            });
        });
        function validateAmount(input) {
            const maxAmount = parseFloat(input.max);
            const value = parseFloat(input.value);

            if (value > maxAmount) {
                input.value = maxAmount;
                alert('You cannot sell more than the available amount.');
            }
        }
        // document.getElementById('defaultModalButton').click();


        document.addEventListener('DOMContentLoaded', function () {
            const ctx = document.getElementById('pieChart').getContext('2d');
            const walletHoldings = @json($walletHoldings);

            const data = {
                labels: Object.keys(walletHoldings),
                datasets: [{
                    data: Object.values(walletHoldings),
                    backgroundColor: [
                        '#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF', '#FF9F40'
                    ],
                    borderWidth: 2
                }]
            };

            const pieChart = new Chart(ctx, {
                type: 'doughnut',
                data: data,
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    cutout: '60%',
                    plugins: {
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    const label = context.label || '';
                                    const value = context.raw || 0;
                                    const total = context.chart._metasets[context.datasetIndex].total;
                                    const percentage = ((value / total) * 100).toFixed(2) + '%';
                                    return `${label}: ${value.toLocaleString()} (${percentage})`;
                                }
                            }
                        },
                        legend: {
                            display: false,
                        }
                    },
                    animation: {
                        animateScale: true,
                        animateRotate: true
                    }
                }
            });

            // Generate the legend
            const legendContainer = document.getElementById('legend');
            Object.entries(walletHoldings).forEach(([key, value], index) => {
                const legendItem = document.createElement('div');
                legendItem.className = 'flex items-center justify-between text-sm';
                legendItem.innerHTML = `
      <div class="flex items-center">
        <span class="inline-block w-3 h-3 mr-2 rounded-full" style="background-color: ${data.datasets[0].backgroundColor[index]};"></span>
        <span class="font-medium text-gray-700 dark:text-gray-300">${key}</span>
      </div>
      <span class="font-semibold text-gray-900 dark:text-gray-100">${value.toLocaleString()}</span>
    `;
                legendContainer.appendChild(legendItem);
            });
        });

    </script>

</x-app-layout>
