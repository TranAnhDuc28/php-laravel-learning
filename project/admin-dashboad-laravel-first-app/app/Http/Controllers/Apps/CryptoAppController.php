<?php

namespace App\Http\Controllers\Apps;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;

class CryptoAppController extends Controller
{
    /**
     * @return Factory|View|Application|object
     */
    public function showCryptoTransactions() {
        return view('apps.crypto.transactions');
    }

    /**
     * @return Factory|View|Application|object
     */
    public function showCryptoBuyAndSell() {
        return view('apps.crypto.buy_sell');
    }

    /**
     * @return Factory|View|Application|object
     */
    public function showCryptoOrders() {
        return view('apps.crypto.orders');
    }

    /**
     * @return Factory|View|Application|object
     */
    public function showCryptoMyWallet() {
        return view('apps.crypto.my_wallet');
    }

    /**
     * @return Factory|View|Application|object
     */
    public function showCryptoIcoList() {
        return view('apps.crypto.ico_list');
    }

    /**
     * @return Factory|View|Application|object
     */
    public function showKycApplication() {
        return view('apps.crypto.kyc_application');
    }
}
