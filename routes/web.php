<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\ProfileController;
use App\Models\Account;
use App\Models\Currency;
use App\Models\Transaction;
use App\Repositories\CoinPaprikaApiCurrencyRepository;
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

    $data = new CoinPaprikaApiCurrencyRepository();
    $accountInfo= //TODO: add account info/balance
    $cryptos = $data->getTop();

    return view('investing.index',[
        'cryptos' => $cryptos,
        'id' => $id
    ]);

})->name('investing');

Route::post('/investing/{id}', function (Request $request,$id) {

    $symbol =$request->currency;
    $purchasePrice = $request->purchase_price;

    $user = auth()->user();
    //TODO: search account number by id


    $data = new CoinPaprikaApiCurrencyRepository();
    $cryptos = $data->getTop();


    $search = null;
    foreach($cryptos as $crypto){
        if($crypto->getSymbol()==$symbol){
            $search=$crypto;
        }
    }
    $user->cryptoWallet()->create(
//        'account_number' => ,
//        'symbol'
    );//TODO

    return redirect("/investing/$id");

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
