<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TemplateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $records = [1];

        session()->put('status', 'OK');

        return view('template', [
            'hello' => '<h1>Hello</h1>',
            'records' => $records
        ]);
    }
}
