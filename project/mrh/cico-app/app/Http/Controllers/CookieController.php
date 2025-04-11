<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CookieController extends Controller
{
    public function updateConsent(Request $request)
    {
        $consent = $request->input('consent');
        $response = response()->json(['message' => 'Cookie preferences updated']);

        if ($consent === 'accepted') {
            $response->cookie('cookie_consent', 'accepted', 60 * 24 * 365);
        } else {
            $response->cookie('cookie_consent', 'rejected', 60 * 24 * 365);
        }

        return $response;
    }
}
