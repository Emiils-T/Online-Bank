<?php

namespace App\Repositories;

use App\Models\CryptoCurrency;

interface CryptoRepository
{
    public function getTop():array;

    public function show(string $symbol):CryptoCurrency;
}
