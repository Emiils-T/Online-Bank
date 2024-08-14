<?php

namespace App\Http\Controllers;


use App\Models\Account;
use App\Service\TransferService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Service\CurrencyRateService;
use Illuminate\View\View;

class AccountController extends Controller
{


    public function show()
    {
        $user = Auth::user();

        $investment = Account::where('user_id', '=', $user->id)
            ->where('type', 'investing')
            ->get();

        $checking = Account::where('user_id', '=', $user->id)
            ->where('type', 'checking')
            ->get();

        return view('index', [
            'investment' => $investment,
            'checking' => $checking
        ]);
    }
    public function create():View
    {
        $currencies = (new CurrencyRateService)->index();

        return view('account.create', ['currencies' => $currencies]);
    }
    public function store():RedirectResponse
    {
        $request = Request();

        if($request->type=='checking'){
            $validated = $request->validate([
                'type' => 'required|string',
                'currency' => 'required|string',
                'starting_amount' => 'required|numeric|min:0',
            ]);

            $user = auth()->user();

            if (!$user) {
                return redirect()->route('login')->withErrors('Please login to create an account.');
            }

            $user->account()->create([
                'account_number' => Str::uuid(),
                'type' => $validated['type'],
                'currency' => $validated['currency'],
                'starting_amount' => $validated['starting_amount'],
                'amount_now' => $validated['starting_amount'],
            ]);
            return redirect(route('dashboard', absolute: false));
        }else{
            $validated = $request->validate([
                'type' => 'required|string',
                'hidden_currency' => 'required|string',
                'starting_amount' => 'required|numeric|min:0',
            ]);

            $user = auth()->user();

            if (!$user) {
                return redirect()->route('login')->withErrors('Please login to create an account.');
            }

            $user->account()->create([
                'account_number' => Str::uuid(),
                'type' => $validated['type'],
                'currency' => 'USD',
                'starting_amount' => $validated['starting_amount'],
                'amount_now' => $validated['starting_amount'],
            ]);
            return redirect(route('dashboard', absolute: false));
        }
    }
}
