<?php

use App\Console\Commands\FetchCryptoCurrencies;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\ProfileController;
use App\Models\Account;
use App\Models\Currency;
use App\Models\Transaction;
use App\Repositories\CryptoCurrencyRepository;
use App\Service\CurrencyRateService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', function () {
    $accounts = Account::all();

    return view('dashboard',
        [
            'accounts' => $accounts
        ]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/transfer', function () {

    $accounts = Account::all();
    return view('account.send', [
        'accounts' => $accounts
    ]);

})->middleware(['auth', 'verified']);

Route::post('/transfer', [AccountController::class, 'transfer'])->name('transfer');

Route::get('/transactions', function () {

    $transactions = Transaction::where('user_id', Auth::id())->get();

    return view('transactions.index', [
        'transactions' => $transactions
    ]);
})->name('transactions');

Route::get('/investing/{id}', function ($id) {

    $data = new CryptoCurrencyRepository();
    $account = Account::where('id', $id)->first();
    $cryptos = $data->index();


//    echo '<pre>';
//    var_dump($cryptos);

    return view('investing.index', [
        'cryptos' => $cryptos,
        'id' => $id,
        'account' => $account
    ]);

})->name('investing');

Route::post('/investing/{id}/buy/{symbol}', function (Request $request, $id,$symbol) {




    $user = auth()->user();
    //TODO: search account number by id




    $account = Account::where('id', $id)->first();

    $purchasePrice = 4;
    $amount = $purchasePrice/$request->price;

    $user->cryptoWallet()->create([
        'account_number' => $account->account_number,
        'symbol' => $symbol,
        'purchase_price' => $purchasePrice,
        'price'=>$request->price,
        'amount' => $amount,
        'value' => $amount*$request->price,
        'value_now' => $amount*$request->price,

    ]);
    $account->amount_now -=$purchasePrice;
    $account->save();

   return redirect("/investing/$id");

});

Route::get('/test', function () {
    $rep = new CryptoCurrencyRepository();
    $data = $rep->index();

    echo $data[0]->symbol;
    var_dump($data);

});

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
