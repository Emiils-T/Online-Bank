<?php

namespace App\Service;

use App\Models\Currency;
use Illuminate\Support\Facades\Http;

class CurrencyRateService
{
    public function index() //TODO : make not static
    {
        return Currency::where('type','=',Currency::TYPE_FIAT)->get();
    }
}
