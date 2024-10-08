<?php

namespace App\View\Components;

use App\Models\CryptoWallet;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CryptoChart extends Component
{
    public function render(): View|Closure|string
    {
        return view('components.crypto-chart');
    }
}
