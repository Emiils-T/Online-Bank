<x-app-layout>
    <div class="2xl:flex 2xl:space-x-[48px] p-6">
        <section class="2xl:flex-1 2xl:mb-0 mb-6">
            <!-- total widget-->
            <div class="w-full mb-[24px]">

                <div class="grid lg:grid-cols-3 grid-cols-1 gap-[24px]">
                    <div class="p-5 rounded-lg bg-white dark:bg-darkblack-600">
                        <div class="flex justify-between items-center mb-5">
                            <div class="flex space-x-[7px] items-center">
                                <div class="icon">
                            <span>
                              <img src="https://spaceraceit.com/html/bankco/assets/images/icons/total-earn.svg"
                                   alt="icon">
                            </span>
                                </div>
                                <span
                                    class="text-lg text-bgray-900 dark:text-white font-semibold">Account Balance</span>
                            </div>

                        </div>
                        <div class="flex justify-between items-end">
                            <div class="flex-1">
                                <p class="text-bgray-900 dark:text-white font-bold text-3xl leading-[48px]">
                                    <img src='{{asset('images/coin_test.png')}}' alt="coin"
                                         class="w-8 h-8 inline-block align-middle -mt-1.5"> {{number_format($account->amount_now,2)}} {{$account->currency}}
                                </p>
                            </div>
                            <div class="w-[106px]">
                                <canvas id="totalEarn" height="68"
                                        style="display: block; box-sizing: border-box; height: 68px; width: 106px;"
                                        width="106"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="p-5 rounded-lg bg-white  dark:bg-darkblack-600">
                        <div class="flex justify-between items-center mb-5">
                            <div class="flex space-x-[7px] items-center">
                                <div class="icon">
                            <span>
                              <img src="https://spaceraceit.com/html/bankco/assets/images/icons/total-earn.svg"
                                   alt="icon">
                            </span>
                                </div>
                                <span
                                    class="text-lg text-bgray-900 dark:text-white  font-semibold">Total Received</span>
                            </div>

                        </div>
                        <div class="flex justify-between items-end">
                            <div class="flex-1">
                                <p class="text-bgray-900 dark:text-white font-bold text-3xl leading-[48px]">
                                    <img src='{{asset('images/coin_test.png')}}' alt="coin"
                                         class="w-8 h-8 inline-block align-middle -mt-1.5">
                                    {{number_format($receive->sum('amount'),2)}} {{$account->currency}}
                                </p>
                            </div>
                            <div class="w-[106px]">
                                <canvas id="totalSpending" height="68"
                                        style="display: block; box-sizing: border-box; height: 68px; width: 106px;"
                                        width="106"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="p-5 rounded-lg bg-white dark:bg-darkblack-600">
                        <div class="flex justify-between items-center mb-5">
                            <div class="flex space-x-[7px] items-center">
                                <div class="icon">
                            <span>
                              <img src="https://spaceraceit.com/html/bankco/assets/images/icons/total-earn.svg"
                                   alt="icon">
                            </span>
                                </div>
                                <span
                                    class="text-lg text-bgray-900 dark:text-white font-semibold">Total Sent</span>
                            </div>
                        </div>
                        <div class="flex justify-between items-end">
                            <div class="flex-1">
                                <p class="text-bgray-900 dark:text-white font-bold text-3xl leading-[48px]">
                                    <img src='{{asset('images/coin_test.png')}}' alt="coin"
                                         class="w-8 h-8 inline-block align-middle -mt-1.5">
                                    {{ number_format($sent->sum('amount'),2)}} {{$account->currency}}
                                </p>
                            </div>
                            <div class="w-[106px]">
                                <canvas id="totalGoal" height="68"
                                        style="display: block; box-sizing: border-box; height: 68px; width: 106px;"
                                        width="106"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- chart -->
            <div class="w-full mb-6 xl:flex xl:space-x-6">
                <div class="flex-1 xl:block hidden">
                    <div class="bg-white dark:bg-darkblack-600 rounded-lg p-6">
                        <div class="border-b border-bgray-300 dark:border-darkblack-400 pb-4 mb-6">
                            <div class="flex justify-between items-center">
                                <h3 class="text-bgray-900 dark:text-white text-xl font-bold">
                                    Transfer/Income
                                </h3>
                            </div>
                        </div>
                        <div class="flex justify-between mb-6">
                            <div class="bg-blue-400 dark:bg-green-900 rounded-lg p-4 flex-1 mx-2 text-center">
                                <span class="block text-white dark:text-green-300 font-semibold">Receive Count</span>
                                <span class="text-2xl font-bold text-white dark:text-green-100"
                                      id="receiveCount">{{$transactions->where('type','receive')->count()}}</span>
                            </div>
                            <div class="bg-red-400 dark:bg-blue-900 rounded-lg p-4 flex-1 mx-2 text-center">
                                <span class="block text-white dark:text-blue-300 font-semibold">Sent Count</span>
                                <span class="text-2xl font-bold text-white dark:text-blue-100"
                                      id="sentCount">{{$transactions->where('type','send')->count()}}</span>
                            </div>
                        </div>
                        <div class="flex flex-col md:flex-row">
                            <div class="w-full md:w-2/3 mb-6 md:mb-0 flex justify-center items-center">
                                <div class="chart-container" style="position: relative; height: 250px;">
                                    <canvas id="pieChart"></canvas>
                                </div>
                            </div>
                            <div class="w-full md:w-1/3 md:pl-6 flex flex-col justify-center">
                                <div class="bg-gray-100 dark:bg-gray-700 rounded-lg p-4">
                                    <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-300 mb-3 text-center">
                                        Holdings Breakdown
                                    </h3>
                                    <div id="legend" class="space-y-2"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--list table-->
            <div class="w-full py-[20px] px-[24px] rounded-lg bg-white dark:bg-darkblack-600">
                <div class="flex flex-col space-y-5">
                    <div class="table-content w-full overflow-x-auto">
                        <table class="w-full">
                            <thead>
                            <tr class="border-b border-bgray-300 dark:border-darkblack-400">
                                <!-- Column Headers -->
                                <th class="text-left py-4 px-6 xl:px-4 text-base text-bgray-900 dark:text-white leading-[24px] font-bold">
                                    Type
                                </th>
                                <th class="text-left py-4 px-6 xl:px-4 text-base text-bgray-900 dark:text-white leading-[24px] font-bold">
                                    Amount
                                </th>
                                <th class="text-left py-4 px-6 xl:px-4 text-base text-bgray-900 dark:text-white leading-[24px] font-bold">
                                    Currency
                                </th>
                                <th class="text-right py-4 px-6 xl:px-4 text-base text-bgray-900 dark:text-white leading-[24px] font-bold">
                                    Transaction Date
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($transactions as $transaction)
                                <tr class="border-b border-bgray-300 dark:border-darkblack-400">
                                    <!-- First Column: Icon and Transaction Type -->
                                    <td class="py-5 px-6 xl:px-4">
                                        <div class="flex items-center space-x-4">
                                            <div class="w-10 h-10 rounded-full overflow-hidden">
                                                @if($transaction->type == 'send')
                                                    <img src="{{asset('images/send.png')}}" alt="send money"
                                                         class="w-full h-full object-cover">
                                                @else
                                                    <img src="{{asset('images/receive.png')}}" alt="receive money"
                                                         class="w-full h-full object-cover">
                                                @endif
                                            </div>
                                            <div>
                                                <p class="text-bgray-900 dark:text-white font-medium">{{ ucfirst($transaction->type) }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <!-- Second Column: Transaction Amount -->
                                    <td class="py-5 px-6 xl:px-4">
                                        <p class="text-base text-bgray-900 dark:text-white font-medium">{{ $transaction->amount }}</p>
                                    </td>
                                    <!-- Third Column: Currency -->
                                    <td class="py-5 px-6 xl:px-4">
                                        <p class="text-base text-bgray-900 dark:text-white font-medium">{{ $transaction->currency }}</p>
                                    </td>
                                    <!-- Fourth Column: Transaction Date -->
                                    <td class="py-5 px-6 xl:px-4 text-right">
                                        <p class="text-base text-bgray-900 dark:text-white font-semibold">{{$transaction->created_at}}</p>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="pagination-content w-full">
                        {{ $transactions->links() }}
                    </div>
                </div>
            </div>
        </section>
        <section
            class="2xl:w-[400px] w-full flex flex-col lg:flex-row 2xl:space-x-0 2xl:flex-col lg:space-x-6 space-x-0">

            <div
                class="2xl:w-full lg:w-1/2 w-full rounded-lg bg-white dark:bg-darkblack-600 dark:border dark:border-darkblack-400 px-[42px] py-5 2xl:mb-6 lg:mb-0 mb-6">
                <div class="my-wallet w-full mb-8">
                    <div class="flex justify-between items-center mb-3">
                        <h3 class="text-lg font-bold text-bgray-900 dark:text-white">
                            Account Number
                        </h3>
                    </div>
                    <div>
                        {{$account->account_number}}
                    </div>
                </div>
            </div>
            <div
                class="2xl:w-full lg:w-1/2 w-full rounded-lg bg-white dark:bg-darkblack-600 dark:border dark:border-darkblack-400 px-[42px] py-5 2xl:mb-6 lg:mb-0 mb-6">
                <div class="my-wallet w-full mb-8">
                    <div class="flex justify-between items-center mb-3">
                        <h3 class="text-lg font-bold text-bgray-900 dark:text-white">
                            Switch Accounts
                        </h3>
                    </div>
                    <div class="flex justify-center">
                        <div class="relative w-full md:w-[340px]">
                            <!-- Account Selection Dropdown -->
                            <div class="relative w-full">
                                <select id="accountSelect"
                                        class="block appearance-none w-full bg-white dark:bg-darkblack-600 border border-gray-300 dark:border-darkblack-400 text-gray-700 dark:text-white py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                        onchange="window.location.href=this.value;">
                                    <option selected disabled>Select an account</option>
                                    @foreach($accounts as $account)
                                        <option value="{{ route('checking', ['id' => $account->id]) }}"
                                            {{ request()->route('id') == $account->id ? 'selected' : '' }}>
                                            {{ $account->account_number }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div
                class="2xl:w-full lg:w-1/2 w-full rounded-lg bg-white dark:bg-darkblack-600 dark:border dark:border-darkblack-400 px-[42px] py-5 2xl:mb-6 lg:mb-0 mb-6">
                <div class="my-wallet w-full mb-8">
                    <div class="flex justify-between items-center mb-3">
                        <h3 class="text-lg font-bold text-bgray-900 dark:text-white">
                            Quick Transfer
                        </h3>
                    </div>
                    <div class="flex justify-center">
                        <div class="relative w-full md:w-[340px]">
                            <form id="transferForm" action="{{ route('transfer') }}" method="POST">
                                @csrf
                                <div class="mb-4">
                                    <label for="accountSelect"
                                           class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">From
                                        Account</label>
                                    <div class="relative">
                                        <select id="accountSelect" name="transferAccount"
                                                class="block appearance-none w-full bg-white dark:bg-darkblack-600 border border-gray-300 dark:border-darkblack-400 text-gray-700 dark:text-white py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                                            <option selected disabled>Select an account</option>
                                            @foreach($accounts as $account)
                                                <option value="{{ $account->account_number }}"
                                                        data-amount="{{ $account->amount_now }}">{{ $account->account_number }}</option>
                                            @endforeach
                                        </select>
                                        <div
                                            class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700 dark:text-white">
                                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                                 viewBox="0 0 20 20">
                                                <path
                                                    d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/>
                                            </svg>
                                        </div>
                                    </div>
                                    <div id="accountAmount" class="mt-2 text-sm text-gray-600 dark:text-gray-300"></div>
                                </div>

                                <div class="mb-4">
                                    <label for="recipientAccount"
                                           class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Recipient
                                        Account</label>
                                    <input type="text" id="recipientAccount" name="recipientAccount"
                                           class="block w-full bg-white dark:bg-darkblack-600 border border-gray-300 dark:border-darkblack-400 text-gray-700 dark:text-white py-3 px-4 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                           placeholder="Enter recipient account number">
                                </div>

                                <div class="mb-4">
                                    <label for="amount"
                                           class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Transfer
                                        Amount</label>
                                    <div class="relative">
                                        <span
                                            class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-700 dark:text-gray-300">$</span>
                                        <input type="number" id="amount" name="amount" step="0.01"
                                               class="block w-full bg-white dark:bg-darkblack-600 border border-gray-300 dark:border-darkblack-400 text-gray-700 dark:text-white py-3 pl-8 pr-4 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                               placeholder="0.00">
                                    </div>
                                </div>

                                <button type="submit"
                                        class="w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-3 px-4 rounded transition duration-300 ease-in-out">
                                    Transfer
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </section>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const accountSelect = document.getElementById('accountSelect');
            const accountAmount = document.getElementById('accountAmount');
            const transferAmount = document.getElementById('transferAmount');

            accountSelect.addEventListener('change', function () {
                const selectedOption = this.options[this.selectedIndex];
                const amount = selectedOption.dataset.amount;
                if (amount) {
                    accountAmount.textContent = `Available Balance: $${amount}`;
                } else {
                    accountAmount.textContent = '';
                }
            });

            transferAmount.addEventListener('input', function () {
                const selectedOption = accountSelect.options[accountSelect.selectedIndex];
                const availableAmount = parseFloat(selectedOption.dataset.amount);
                const enteredAmount = parseFloat(this.value);

                if (enteredAmount > availableAmount) {
                    this.setCustomValidity('Transfer amount exceeds available balance');
                } else {
                    this.setCustomValidity('');
                }
            });
        });

        const ctx = document.getElementById('pieChart').getContext('2d');
        const chart = @json($chart);
        const data = {
            labels: Object.keys(chart),
            datasets: [{
                data: Object.values(chart),
                backgroundColor: ['#FF6384', '#36A2EB'],
                hoverBackgroundColor: ['#FF6384', '#36A2EB']
            }]
        };

        const pieChart = new Chart(ctx, {
            type: 'pie',
            data: data,
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: false
                    }
                }
            }
        });

        // Custom legend
        const legend = document.getElementById('legend');
        data.labels.forEach((label, index) => {
            const legendItem = document.createElement('div');
            legendItem.classList.add('flex', 'items-center');

            // Format the number to two decimal places
            const formattedValue = parseFloat(data.datasets[0].data[index]).toFixed(2);

            legendItem.innerHTML = `
        <span class="w-4 h-4 mr-2" style="background-color: ${data.datasets[0].backgroundColor[index]}"></span>
        <span>${label}: $${formattedValue}</span>
    `;
            legend.appendChild(legendItem);
        });
    </script>

</x-app-layout>
