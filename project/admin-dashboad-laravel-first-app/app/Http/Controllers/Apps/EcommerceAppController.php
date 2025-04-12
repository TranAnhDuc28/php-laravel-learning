<?php

namespace App\Http\Controllers\Apps;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;

class EcommerceAppController extends Controller
{
    /**
     * @return Factory|View|Application|object
     */
    public function showProducts() {
        return view('apps.ecommerce.products');
    }

    /**
     * @return Factory|View|Application|object
     */
    public function showProductDetails() {
        return view('apps.ecommerce.product_details');
    }

    /**
     * @return Factory|View|Application|object
     */
    public function showCreateProduct() {
        return view('apps.ecommerce.create_product');
    }

    /**
     * @return Factory|View|Application|object
     */
    public function showOrders() {
        return view('apps.ecommerce.orders');
    }

    /**
     * @return Factory|View|Application|object
     */
    public function showOrderDetails() {
        return view('apps.ecommerce.order_details');
    }

    /**
     * @return Factory|View|Application|object
     */
    public function showCustomers() {
        return view('apps.ecommerce.customers');
    }

    /**
     * @return Factory|View|Application|object
     */
    public function showShoppingCart() {
        return view('apps.ecommerce.shopping_cart');
    }

    /**
     * @return Factory|View|Application|object
     */
    public function showCheckout() {
        return view('apps.ecommerce.checkout');
    }

    /**
     * @return Factory|View|Application|object
     */
    public function showSellers() {
        return view('apps.ecommerce.sellers');
    }

    /**
     * @return Factory|View|Application|object
     */
    public function showSellerDetails() {
        return view('apps.ecommerce.seller_details');
    }
}
