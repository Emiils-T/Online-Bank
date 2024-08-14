<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\CryptoWallet;
use Illuminate\Http\Request;

class CryptoController extends Controller
{
    public function buy(Request $request, $account_id, $symbol)
    {
        //TODO add controller

        $user = auth()->user();
        //TODO: validate if crypto is in currencies table
        //TODO: validate if buy amount <= account balance

        $account = Account::where('id', $account_id)->first();


        $cryptoWalletEntry = $user->cryptoWallet()->firstOrNew([
            'account_number' => $account->account_number,
            'symbol' => $symbol,
        ]);

        $logo=$request->logo;

        $purchasePrice = $request->purchase_price;
        $price = $request->price;
        $additionalAmount = $purchasePrice / $price;

        $cryptoWalletEntry->purchase_price += $purchasePrice;
        $cryptoWalletEntry->amount += $additionalAmount;
        $cryptoWalletEntry->value += $request->purchase_price;
        $cryptoWalletEntry->value_now = $cryptoWalletEntry->amount * $price;
        $cryptoWalletEntry->price = $price;
        $cryptoWalletEntry->logo = $logo;

        $cryptoWalletEntry->save();

        $account->amount_now -= $purchasePrice;
        $account->save();

        return redirect("/investing/$account_id");
    }

    public function sell(Request $request, $account_id, $symbol)
    {
        $user = auth()->user();


        $account = Account::where('id', $account_id)->first();
        print_r($account->account_number);
        print_r($request->amount);
        print_r($symbol);


        $request->validate([
            'amount' => 'required|numeric|min:0.00001',
            'price' => 'required|numeric|min:0',
        ]);


        $cryptoWallet = CryptoWallet::where([
            'account_number' => $account->account_number,
            'symbol' => $symbol,
        ])->first();


        // Calculate the new values
        $amountToSell = $request->amount;
        $currentAmount = $cryptoWallet->amount;

        if ($amountToSell > $currentAmount) {
            return redirect()->back()->with('error', 'Insufficient amount to sell.');
        }
        if ($amountToSell == $currentAmount) {
            $cryptoWallet->delete();

            $account->amount_now += $amountToSell * $request->price;
            $account->save();
            return redirect("/investing/$account_id");
        } else {
            $newAmount = $currentAmount - $amountToSell;
            $currentPrice = $cryptoWallet->price;
            $currentValue = $currentAmount * $currentPrice;


            $cryptoWallet->update([
                'amount' => $newAmount,
                'value' => $newAmount * $currentPrice,
                'value_now' => $newAmount * $currentPrice,
            ]);


            $account->amount_now += $amountToSell * $request->price;
            $account->save();


            return redirect("/investing/$account_id");
        }
    }
}
