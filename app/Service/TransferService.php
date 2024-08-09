<?php

namespace App\Service;

use App\Models\Account;
use App\Models\Currency;
use App\Models\Transaction;

class TransferService
{
    public function transfer($request)
    {
        $validated = $request->validate([
            'recipientAccount' => 'required|string',
            'transferAccount' => 'required|string',
            'amount' => 'required|numeric|min:0',
        ]);
        $user = auth()->user();


        if (!$user) {
            return redirect()->route('login')->withErrors('Please login to create an account.');
        }

        $transferAccount = Account::where('account_number', $validated['transferAccount'])->first();

        $recipientAccount = Account::where('account_number', $validated['recipientAccount'])->first();

        $transferRate=Currency::where('type',Currency::TYPE_FIAT)
            ->where('symbol',$transferAccount->currency)
            ->first();
        $receiveRate=Currency::where('type',Currency::TYPE_FIAT)
            ->where('symbol',$recipientAccount->currency)
            ->first();

        $baseRate = 1;

        $rate = $transferRate->price/$receiveRate->price;


        $convertedAmount = $validated['amount']*($baseRate/$rate);



        $user->transaction()->create([
            'account_number'=>$validated['transferAccount'],
            'type'=>Transaction::TYPE_SEND,
            'currency'=>$transferAccount->currency,
            'amount'=>$validated['amount'],
        ]);


        Transaction::create([
            'user_id'=>$recipientAccount->user_id,
            'account_number'=>$validated['transferAccount'],
            'type'=>Transaction::TYPE_RECEIVE,
            'currency'=>$transferAccount->currency,
            'amount'=>$validated['amount'],
        ]);



        $transferAccount->amount_now -= $validated['amount'];
        $transferAccount->save();

        $recipientAccount->amount_now += $convertedAmount;
        $recipientAccount->save();

    }
}
