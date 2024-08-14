<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class TransactionController extends Controller
{
    public function index():View
    {
        //TODO add controller

        $transactions = Transaction::where('user_id', Auth::id())->paginate(10);

        return view('transactions.index', [
            'transactions' => $transactions
        ]);
    }
}
