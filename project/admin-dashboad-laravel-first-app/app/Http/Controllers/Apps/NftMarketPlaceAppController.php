<?php

namespace App\Http\Controllers\Apps;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;

class NftMarketPlaceAppController extends Controller
{
    /**
     * @return Factory|View|Application|object
     */
    public function showMarketPlace() {
        return view('apps.nft_marketplace.marketplace');
    }

    /**
     * @return Factory|View|Application|object
     */
    public function showExploreNow() {
        return view('apps.nft_marketplace.explore_now');
    }

    /**
     * @return Factory|View|Application|object
     */
    public function showLiveAuction() {
        return view('apps.nft_marketplace.live-auction');
    }

    /**
     * @return Factory|View|Application|object
     */
    public function showItemDetails() {
        return view('apps.nft_marketplace.item-details');
    }

    /**
     * @return Factory|View|Application|object
     */
    public function showCollections() {
        return view('apps.nft_marketplace.collections');
    }

    /**
     * @return Factory|View|Application|object
     */
    public function showCreators() {
        return view('apps.nft_marketplace.creators');
    }

    /**
     * @return Factory|View|Application|object
     */
    public function showRanking() {
        return view('apps.nft_marketplace.ranking');
    }

    /**
     * @return Factory|View|Application|object
     */
    public function showWalletConnect() {
        return view('apps.nft_marketplace.wallet_connect');
    }

    /**
     * @return Factory|View|Application|object
     */
    public function showCreateNFT() {
        return view('apps.nft_marketplace.create_nft');
    }
}
