<?php

namespace App\Http\Controllers;

use App\Models\Currency;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CurrencyController extends Controller
{
    public function index()
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
