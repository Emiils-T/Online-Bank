<?php

namespace App\Http\Controllers;

use App\Models\CryptoWallet;
use Illuminate\Http\Request;

class ChartController extends Controller
{
    public function pieChart()
    {
        try {
            $user = auth()->user();
            if (!$user) {
                return response()->json(['error' => 'User not authenticated'], 401);
            }

            $crypto = CryptoWallet::where('user_id', $user->id)->get();
            $data = $crypto->map(function ($item) {
                return [
                    'currency' => $item->symbol,
                    'valueNow' => $item->value_now,
                ];
            })->toArray();

            return view('components.bar-chart', ['chartData' => json_encode($data)]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred'], 500);
        }
    }
}
