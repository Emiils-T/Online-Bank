<?php

namespace App\Repositories;

use App\Models\Currency;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class CryptoCurrencyRepository implements CurrencyRepository
{

    public function __construct()
    {
    }

    public function index()
    {
        $data = Currency::where('type','=',Currency::TYPE_CRYPTO)->get();



        return $data;
    }

    public function show(string $symbol): Currency
    {
        $search = Currency::where('symbol','=',$symbol)->where('type','=',Currency::TYPE_CRYPTO)->first();
        return $search;
    }
}
