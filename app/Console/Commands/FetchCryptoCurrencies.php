<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

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
        $response = Http::get('https://api.coinpaprika.com/v1/tickers');
        $data = json_decode($response->getBody(),true);
        $data = array_slice($data,0,100);
        $data = json_encode($data);

        Cache::put('crypto_currencies',$data);
    }
}
