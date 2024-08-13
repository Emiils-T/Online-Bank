<?php

namespace App\Console\Commands;

use App\Models\Currency;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class AddCoinLogo extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:add-coin-logo';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $response = Http::get('https://api.coinpaprika.com/v1/tickers');
        $data = json_decode($response->getBody());

        foreach ($data as $crypto) {
            Currency::updateOrCreate(
                [
                    'symbol' => $crypto->symbol,
                    'type' => Currency::TYPE_CRYPTO
                ],
                [
                    'logo'=>"https://static.coinpaprika.com/coin/$crypto->id/logo.png",
                ]
            );
        }
    }
}
