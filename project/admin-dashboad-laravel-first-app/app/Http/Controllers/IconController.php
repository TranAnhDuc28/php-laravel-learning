<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;

class IconController extends Controller
{
    /**
     * @return Factory|View|Application|object
     */
    public function showRemixIcons()
    {
        return view('icons.remix');
    }

    /**
     * @return Factory|View|Application|object
     */
    public function showBoxicons()
    {
        return view('icons.boxicons');
    }

    /**
     * @return Factory|View|Application|object
     */
    public function showMaterialIcons()
    {
        return view('icons.material_design');
    }

    /**
     * @return Factory|View|Application|object
     */
    public function showLineAwesomeIcons()
    {
        return view('icons.line_awesome');
    }

    /**
     * @return Factory|View|Application|object
     */
    public function showFeatherIcons()
    {
        return view('icons.feather');
    }

    /**
     * @return Factory|View|Application|object
     */
    public function showCryptoIcons()
    {
        return view('crypto.blade.php');
    }
}
