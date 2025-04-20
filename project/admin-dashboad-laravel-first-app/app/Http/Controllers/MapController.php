<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;

class MapController extends Controller
{
    /**
     * @return Factory|View|Application|object
     */
    public function showGoogleMaps()
    {
        return view('maps.google');
    }

    /**
     * @return Factory|View|Application|object
     */
    public function showVectorMaps()
    {
        return view('maps.vector');
    }

    /**
     * @return Factory|View|Application|object
     */
    public function showLeafletMaps()
    {
        return view('maps.leaflet');
    }
}
