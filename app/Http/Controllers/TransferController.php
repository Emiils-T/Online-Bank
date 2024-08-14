<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Service\TransferService;

class TransferController extends Controller
{
    private TransferService $transferService;

    public function __construct(TransferService $transferService)
    {
        $this->transferService = $transferService;
    }

    public function create()
    {
        $user = Auth::user();

        $accounts = Account::where('user_id', $user->id)
            ->where('type', Account::TYPE_CHECKING)
            ->get();
        return view('account.send', [
            'accounts' => $accounts
        ]);
    }
    public function store(Request $request)
    {
        $this->transferService->transfer($request);
        return redirect(route('dashboard', absolute: false));
    }
}
