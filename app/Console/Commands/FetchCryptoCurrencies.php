<?php

namespace App\Console\Commands;

use App\Models\Currency;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class FetchCryptoCurrencies extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:fetch-crypto';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch Crypto currencies from API (CoinPaprika)';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        Log::info('fetching crypto currencies');

        $response = Http::get('https://api.coinpaprika.com/v1/tickers');
        $data = json_decode($response->getBody());

        foreach ($data as $crypto) {
            Currency::updateOrCreate(
                [
                    'symbol' => $crypto->symbol,
                    'type' => Currency::TYPE_CRYPTO
                ],
                [
                    'name'=>$crypto->name,
                    'price'=>$crypto->quotes->USD->price,
                    '1h_change' =>$crypto->quotes->USD->percent_change_1h,
                    '12h_change'=>$crypto->quotes->USD->percent_change_12h,
                    '24h_change'=>$crypto->quotes->USD->percent_change_24h,
                    '7d_change'=>$crypto->quotes->USD->percent_change_7d,
                    'market_cap'=>$crypto->quotes->USD->market_cap,
                ]
            );
        }

    }
}
