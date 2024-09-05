<?php

use App\Console\Commands\FetchCryptoCurrencies;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\CheckingAccountController;
use App\Http\Controllers\CryptoController;
use App\Http\Controllers\InvestmentAccountController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\TransferController;
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

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/home', [AccountController::class, 'show'])->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/account/create', [AccountController::class, 'create'])->middleware(['auth', 'verified'])->name('account.create');
Route::post('/account/create', [AccountController::class, 'store'])->name('account.store');

Route::get('/transfer', [TransferController::class, 'create'])->middleware(['auth', 'verified']);
Route::post('/transfer', [TransferController::class, 'store'])->name('transfer');

Route::get('/transactions', [TransactionController::class, 'index'])->name('transactions');

Route::get('/checking/{id}', [CheckingAccountController::class, 'index'])->middleware(['auth', 'verified'])->name('checking');

Route::get('/investing/{account_id}', [InvestmentAccountController::class, 'index'])->name('investing');
Route::post('/investing/{account_id}/buy/{symbol}', [CryptoController::class, 'buy']);
Route::post('/investing/{account_id}/sell/{symbol}', [CryptoController::class, 'sell']);

Route::get('/test', function () {
    return view('test');
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

});


require __DIR__ . '/auth.php';
