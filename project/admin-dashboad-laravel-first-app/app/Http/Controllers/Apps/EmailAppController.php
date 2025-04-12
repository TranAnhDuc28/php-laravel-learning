<?php

namespace App\Http\Controllers\Apps;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;

class EmailAppController extends Controller
{
    /**
     * @return Factory|View|Application|object
     */
    public function showMailbox() {
        return view('apps.email.mailbox');
    }

    /**
     * @return Factory|View|Application|object
     */
    public function showEmailTemplateBasic() {
        return view('apps.email.email_templates.basic-action');
    }

    /**
     * @return Factory|View|Application|object
     */
    public function showEmailTemplateEcommerce() {
        return view('apps.email.email_templates.ecommerce-action');
    }
}
