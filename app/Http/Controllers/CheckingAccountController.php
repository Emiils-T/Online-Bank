<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;

class CheckingAccountController extends Controller
{
    public function index($id)
    {
        $user = auth()->user();

        $account = $user->account()->where('id', $id)->first();
        $accounts = Account::where('user_id', $user->id)
            ->where('type',Account::TYPE_CHECKING)
            ->get();
        $transactions = $user->transaction()->where('account_number',$account->account_number)->paginate(10, ['*'], 'transactions');
        $sent = $transactions->where('type',Transaction::TYPE_SEND);
        $receive = $transactions->where('type',Transaction::TYPE_RECEIVE);
        $chartData =[
            'sent'=>$transactions->where('type',Transaction::TYPE_SEND)->sum('amount'),
            'receive'=>$transactions->where('type',Transaction::TYPE_RECEIVE)->sum('amount'),
        ];



        return view('checking.index',
            [
                'account' => $account,
                'accounts' => $accounts,
                'sent' => $sent,
                'receive' => $receive,
                'transactions' => $transactions,
                'chart' => $chartData,
            ]);
    }
}
