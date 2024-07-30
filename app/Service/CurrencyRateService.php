<?php

namespace App\Service;

use App\Models\Currency;
use Illuminate\Support\Facades\Http;

class CurrencyRateService
{
    public function index() //TODO : make not static
    {
        $response = Http::get('https://www.bank.lv/vk/ecb.xml');
        $xml = simplexml_load_string($response->body());

        $currencies = collect();


        foreach ($xml->Currencies->Currency as $currency) {

            $currencies->add(new Currency((string)$currency->ID,(float)$currency->Rate));
        }

        return $currencies->where(function (Currency $currency) {

            return $currency;
        });
    }
}
