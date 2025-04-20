<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;
use Illuminate\Pagination\LengthAwarePaginator;

trait ApiResponseTrait
{
    /**
     * Send a success or warning response.
     *
     * @param mixed $responseCodeEnum Enum instance with toResponseObject() method
     * @param string|null $message Override default message
     * @return JsonResponse
     */
    public function sendSuccessResponse(mixed $responseCodeEnum, ?string $message = null): JsonResponse
    {
        $responseObject = $responseCodeEnum->toResponseObject();
        return response()->json([
            'status' => $responseObject->status,
            'returnCode' => $responseObject->returnCode,
            'message' => $message ?? $responseObject->message,
        ], $responseObject->status);
    }

    /**
     * Send an Error response.
     *
     * @param mixed $responseCodeEnum Enum instance with toResponseObject() method
     * @param array|null $errors Additional error details
     * @param string|null $message Override default message
     * @return JsonResponse
     */
    public function sendErrorResponse(mixed $responseCodeEnum, ?array $errors = null, ?string $message = null): JsonResponse
    {
        $responseObject = $responseCodeEnum->toResponseObject();

        return response()->json([
            'status' => $responseObject->status,
            'returnCode' => $responseObject->returnCode,
            'message' => $message ?? $responseObject->message,
            'errors' => $errors,
        ], $responseObject->status);
    }

    /**
     * Send a Data response (list of items).
     *
     * @param mixed $responseCodeEnum Enum instance with toResponseObject() method
     * @param mixed $items Data to return (array, collection, or paginator)
     * @param string|null $warning Warning message
     * @param string|null $message Override default message
     * @param string|null $resourceClass Resource class to format items
     * @return JsonResponse
     */
    public function sendDataResponse(mixed $responseCodeEnum, mixed $items, ?string $message = null, ?string $resourceClass = null, ?string $warning = null,): JsonResponse {
        $responseObject = $responseCodeEnum->toResponseObject();

        // Handle pagination or collection
        $count = $items instanceof LengthAwarePaginator ? $items->total() : (is_countable($items) ? count($items) : 0);
        $formattedItems = $items instanceof LengthAwarePaginator ? $items->items() : $items;

        // Apply resource class if provided
        if ($resourceClass && class_exists($resourceClass)) {
            $formattedItems = $resourceClass::collection($formattedItems);
        }

        $response = [
            'status' => $responseObject->status,
            'returnCode' => $responseObject->returnCode,
            'message' => $message ?? $responseObject->message,
            'count' => $count,
            'items' => $formattedItems,
        ];

        if ($warning !== null) {
            $response['warning'] = $warning;
        }

        return response()->json($response, $responseObject->status);
    }

    /**
     * Send an Individual response (single item or custom data).
     *
     * @param mixed $responseCodeEnum Enum instance with toResponseObject() method
     * @param array $data Custom data to include, wrapped in 'data' field
     * @param string|null $warning Warning message
     * @param string|null $message Override default message
     * @return JsonResponse
     */
    public function sendIndividualResponse(mixed $responseCodeEnum, array $data, ?string $warning = null, ?string $message = null): JsonResponse {
        $responseObject = $responseCodeEnum->toResponseObject();

        $response = [
            'status' => $responseObject->status,
            'returnCode' => $responseObject->returnCode,
            'message' => $message ?? $responseObject->message,
        ];

        // Add warning if provided
        if ($warning !== null) {
            $response['warning'] = $warning;
        }

        // Wrap custom data in 'data' field
        if (!empty($data)) {
            $response['data'] = $data;
        }

        return response()->json($response, $responseObject->status);
    }
}
