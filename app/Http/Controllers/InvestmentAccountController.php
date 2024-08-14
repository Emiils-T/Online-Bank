<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\CryptoWallet;
use App\Models\Currency;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;

class InvestmentAccountController extends Controller
{
    public function index($account_id):View
    {
        $user = Auth::user();

        $account = Account::where('id', $account_id)->first();

        $cryptoWallet = CryptoWallet::where('account_number', $account->account_number)
            ->paginate(10, ['*'], 'wallet');


        $cryptoSum = Auth::user()->cryptoWallet()
            ->where('account_number', $account->account_number)
            ->sum('value_now');

        $cryptos = Currency::where('type', '=', Currency::TYPE_CRYPTO)->paginate(10, ['*'], 'cryptos');

        $walletHoldings = [];
        foreach ($cryptoWallet as $crypto) {
            $walletHoldings[$crypto->symbol] = $crypto->value_now;
        }


        return view('investing.index', [
            'cryptos' => $cryptos,
            'account' => $account,
            'cryptoSum' => $cryptoSum,
            'cryptoWallet' => $cryptoWallet,
            'walletHoldings' => $walletHoldings,
        ]);
    }
}
