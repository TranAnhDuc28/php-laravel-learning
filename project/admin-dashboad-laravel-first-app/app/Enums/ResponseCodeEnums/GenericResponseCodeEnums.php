<?php

namespace App\Enums\ResponseCodeEnums;

use Exception;

/**
 *  Range code type success
 *  Range code type error from -1 to -100
 */
enum GenericResponseCodeEnums: int
{
    case VALIDATION_ERROR = -1;
    case SERVER_ERROR = -2;
    case NOT_FOUND = -3;

    private const METADATA = [
        self::VALIDATION_ERROR->value => ['status' => 400, 'type' => 'error'],
        self::SERVER_ERROR->value => ['status' => 500, 'type' => 'error'],
        self::NOT_FOUND->value => ['status' => 404, 'type' => 'error'],
    ];

    /**
     * @throws Exception
     */
    public function toResponseObject(): object
    {
        $metadata = self::METADATA[$this->value] ?? throw new Exception("No metadata for {$this->name}");
        return (object)[
            'status' => $metadata['status'],
            'returnCode' => $this->value,
            'message' => __('response_message.generic.' . $this->name),
        ];
    }
}
