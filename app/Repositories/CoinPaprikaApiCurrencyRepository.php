<?php

namespace App\Repositories;

use App\Models\CryptoCurrency;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class CoinPaprikaApiCurrencyRepository implements CryptoRepository
{

    public function __construct()
    {
    }

    public function getTop(): array
    {
        $data = Cache::get('crypto_currencies');

        $data = json_decode($data);

        $cryptoCurrencies = [];


        foreach ($data as $currency) {
            $cryptoCurrencies[] = new CryptoCurrency(
                $currency->id,
                $currency->name,
                $currency->symbol,
                $currency->quotes->USD->price
            );

        }

        return $cryptoCurrencies;


    }

    public function show(string $symbol): CryptoCurrency
    {
        // TODO: Implement show() method.
    }
}
