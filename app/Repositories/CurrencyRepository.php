<?php

namespace App\Repositories;

use App\Models\Currency;

interface CurrencyRepository
{
    public function index();


    public function show(string $symbol):Currency;
}
