<?php

use App\Console\Commands\FetchCryptoCurrencies;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\ChartController;
use App\Http\Controllers\ProfileController;
use App\Models\Account;
use App\Models\CryptoWallet;
use App\Models\Currency;
use App\Models\Transaction;
use App\Repositories\CryptoCurrencyRepository;
use App\Service\CurrencyRateService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;


//TODO add checking account dashboard
//TODO add controllers
//TODO add exchange rate conversion when transfering
//TODO add receive transaction for transfers
//TODO add transaction for Crypto


Route::get('/', function () {
    return view('auth.login');
});

Route::get('/home', function () {
    $user = Auth::user();

    $investment = Account::where('user_id', '=', $user->id)
        ->where('type', 'investing')
        ->get();

    $checking = Account::where('user_id', '=', $user->id)
        ->where('type', 'checking')
        ->get();

    return view('test', [
        'investment' => $investment,
        'checking' => $checking
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/transfer', function () {

    $user = Auth::user();

    $accounts = Account::where('user_id', $user->id)
        ->where('type', Account::TYPE_CHECKING)
        ->get();
    return view('account.send', [
        'accounts' => $accounts
    ]);

})->middleware(['auth', 'verified']);

Route::post('/transfer', [AccountController::class, 'transfer'])->name('transfer');

Route::get('/transactions', function () {

    //TODO add controller

    $transactions = Transaction::where('user_id', Auth::id())->paginate(10);

    return view('transactions.index', [
        'transactions' => $transactions
    ]);
})->name('transactions');

Route::get('/investing/{account_id}', function ($account_id) {

    //TODO add controller

    $user = Auth::user();

    $account = Account::where('id', $account_id)->first();

    $cryptoWallet = CryptoWallet::where('account_number', $account->account_number)
        ->paginate(10, ['*'], 'wallet');


    $cryptoSum = Auth::user()->cryptoWallet()
        ->where('account_number', $account->account_number)
        ->sum('value_now');

//    $cryptos = (new CryptoCurrencyRepository())->index();
    $cryptos = Currency::where('type', '=', Currency::TYPE_CRYPTO)->paginate(10, ['*'], 'cryptos');

    $walletHoldings = [];
    foreach ($cryptoWallet as $crypto) {
        $walletHoldings[$crypto->symbol] = $crypto->value_now;
    }


    return view('investing.index', [
        'cryptos' => $cryptos,
        'account' => $account,
        'cryptoSum' => $cryptoSum,
        'cryptoWallet' => $cryptoWallet,
        'walletHoldings' => $walletHoldings,
    ]);

})->name('investing');


Route::post('/investing/{account_id}/buy/{symbol}', function (Request $request, $account_id, $symbol) {
    //TODO add controller

    $user = auth()->user();
    //TODO: validate if crypto is in currencies table
    //TODO: validate if buy amount <= account balance

    $account = Account::where('id', $account_id)->first();


    $cryptoWalletEntry = $user->cryptoWallet()->firstOrNew([
        'account_number' => $account->account_number,
        'symbol' => $symbol,
    ]);

    $logo=$request->logo;

    $purchasePrice = $request->purchase_price;
    $price = $request->price;
    $additionalAmount = $purchasePrice / $price;

    $cryptoWalletEntry->purchase_price += $purchasePrice;
    $cryptoWalletEntry->amount += $additionalAmount;
    $cryptoWalletEntry->value += $request->purchase_price;
    $cryptoWalletEntry->value_now = $cryptoWalletEntry->amount * $price;
    $cryptoWalletEntry->price = $price;
    $cryptoWalletEntry->logo = $logo;

    $cryptoWalletEntry->save();

    $account->amount_now -= $purchasePrice;
    $account->save();

    return redirect("/investing/$account_id");

});
Route::post('/investing/{account_id}/sell/{symbol}', function (Request $request, $account_id, $symbol) {
    //TODO add controller

    $user = auth()->user();


    $account = Account::where('id', $account_id)->first();
    print_r($account->account_number);
    print_r($request->amount);
    print_r($symbol);


    $request->validate([
        'amount' => 'required|numeric|min:0.00001',
        'price' => 'required|numeric|min:0',
    ]);


    $cryptoWallet = CryptoWallet::where([
        'account_number' => $account->account_number,
        'symbol' => $symbol,
    ])->first();


    // Calculate the new values
    $amountToSell = $request->amount;
    $currentAmount = $cryptoWallet->amount;

    if ($amountToSell > $currentAmount) {
        return redirect()->back()->with('error', 'Insufficient amount to sell.');
    }
    if ($amountToSell == $currentAmount) {
        $cryptoWallet->delete();

        $account->amount_now += $amountToSell * $request->price;
        $account->save();
        return redirect("/investing/$account_id");
    } else {
        $newAmount = $currentAmount - $amountToSell;
        $currentPrice = $cryptoWallet->price;
        $currentValue = $currentAmount * $currentPrice;

        // Update the crypto wallet entry
        $cryptoWallet->update([
            'amount' => $newAmount,
            'value' => $newAmount * $currentPrice, // Update the value based on the new amount
            'value_now' => $newAmount * $currentPrice,
        ]);

        // Update the account balance
        $account->amount_now += $amountToSell * $request->price;
        $account->save();


        return redirect("/investing/$account_id");
    }


});

Route::get('/test',function (){

    //$response = Http::get('https://api.coinpaprika.com/v1/coins/btc-bitcoin');
    $response = Http::get('https://api.coinpaprika.com/v1/tickers');

    $data = json_decode($response->getBody());
    echo '<pre>';
    var_dump($data[0]->id);
});


//Route::get('/test', function () {
//    $user = Auth::user();
//
//    $investment = Account::where('user_id', '=', $user->id)
//        ->where('type', 'investing')
//        ->get();
////    dd($investment);
////    foreach ($investment as $account) {
////        echo $account->id;
////    }die;
//    $checking = Account::where('user_id', '=', $user->id)
//        ->where('type', 'checking')
//        ->get();
//    return view('test', [
//        'investment' => $investment,
//        'checking' => $checking
//    ]);
//});


//Route::post('/test', function (Request $request) {
//
//});


Route::get('/account/create', function () {
    $currencies = (new App\Service\CurrencyRateService)->index();//TODO: make controller

    return view('account.create', ['currencies' => $currencies]);
})->middleware(['auth', 'verified'])->name('account.create');


Route::post('/account/create', [AccountController::class, 'store'])->name('account.store');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

});


require __DIR__ . '/auth.php';
