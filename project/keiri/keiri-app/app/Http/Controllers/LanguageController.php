<?php

namespace App\Http\Controllers;

use App\Enums\Language;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class LanguageController extends Controller
{
    /**
     * Language switcher.
     *
     * @param Request $request
     * @param $locale
     * @return RedirectResponse
     */
    public function switchLanguage(Request $request, $locale)
    {
        $validator = Validator::make(['locale' => $locale], [
            'locale' => ['required', Rule::enum(Language::class)],
        ]);

        if (!$validator->fails()) {
            Session::put('locale', $locale);
        }

        return redirect()->back();
    }
}
