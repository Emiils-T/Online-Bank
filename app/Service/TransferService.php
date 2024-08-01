<?php

namespace App\Service;

use App\Models\Account;
use Illuminate\Http\Request;
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

        $user->transaction()->create([
            'account_number'=>$validated['transferAccount'],
            'type'=>'transfer',
            'currency'=>$transferAccount->currency,
            'amount'=>$validated['amount'],
        ]);



        $recipientAccount->amount_now += $validated['amount'];
        $transferAccount->amount_now -= $validated['amount'];
        $transferAccount->save();
        $recipientAccount->save();

    }
}
