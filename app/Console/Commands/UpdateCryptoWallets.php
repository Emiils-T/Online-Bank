<?php

namespace App\Console\Commands;

use App\Models\CryptoWallet;
use App\Repositories\CryptoCurrencyRepository;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Auth;

class UpdateCryptoWallets extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update-crypto-wallets';

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
        $cryptoWallet = CryptoWallet::all();
        foreach ($cryptoWallet as $crypto) {
            $cryptoRepository = new CryptoCurrencyRepository();

            $updatedCrypto = $cryptoRepository->show($crypto->symbol);
            $valueNow = $updatedCrypto->price*$crypto->amount;

            CryptoWallet::where('symbol',$crypto->symbol)->update(
                [
                    'price'=>$updatedCrypto->price,
                    'value_now'=>$valueNow,
                ]
            );
        }
    }
}
