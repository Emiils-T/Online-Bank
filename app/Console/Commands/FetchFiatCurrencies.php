<?php

namespace App\Console\Commands;

use App\Models\Currency;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class FetchFiatCurrencies extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:fetch-fiat';

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
        $response = Http::get('https://www.bank.lv/vk/ecb.xml');
        $xml = simplexml_load_string($response->body());

        Currency::updateOrCreate(
            [
                'symbol' => 'EUR',
                'type' => Currency::TYPE_FIAT
            ],
            [
                'price'=>1
            ]
        );

        foreach ($xml->Currencies->Currency as $currency) {

            Currency::updateOrCreate(
                [
                    'symbol' => $currency->ID,
                    'type' => Currency::TYPE_FIAT
                ],
                [

                    'price'=>$currency->Rate,
                ]
            );

        }

    }
}
