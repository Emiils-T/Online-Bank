<?php

namespace App\Http\Controllers;


use App\Service\TransferService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AccountController extends Controller
{

    private TransferService $transferService;

    public function __construct(TransferService $transferService)
    {
        $this->transferService = $transferService;
    }

    public function create()
    {
        return view('account.create',);
    }

    public function store()
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

    public function transfer(Request $request)
    {
        $this->transferService->transfer($request);
        return redirect(route('dashboard', absolute: false));
    }
}
