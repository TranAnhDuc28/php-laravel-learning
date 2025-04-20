<?php

namespace App\Http\Controllers\Api\V1;

use App\Enums\ResponseCodeEnums\EventResponseCodeEnums;
use App\Enums\ResponseCodeEnums\GenericResponseCodeEnums;
use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Throwable;

class EventController extends Controller
{
    use ApiResponseTrait;

    /**
     * Display a listing of the resource.
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        try {
            $events = Event::all();
            return $this->sendDataResponse(EventResponseCodeEnums::EVENT_LIST, $events);
        } catch (Throwable $th) {
            return $this->sendErrorResponse(GenericResponseCodeEnums::SERVER_ERROR, message: $th->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
