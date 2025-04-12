<?php

namespace App\Http\Controllers\Apps;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;

class InvoiceAppController extends Controller
{
    /**
     * @return Factory|View|Application|object
     */
    public function showInvoiceList() {
        return view('apps.invoices.invoice_list');
    }

    /**
     * @return Factory|View|Application|object
     */
    public function showInvoiceDetails() {
        return view('apps.invoices.invoice_details');
    }

    /**
     * @return Factory|View|Application|object
     */
    public function showCreateInvoice() {
        return view('apps.invoices.create_invoice');
    }
}
