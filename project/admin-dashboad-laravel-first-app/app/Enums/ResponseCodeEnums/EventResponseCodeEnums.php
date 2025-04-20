<?php

namespace App\Enums\ResponseCodeEnums;

use Exception;

/**
 * Range code type success from -1000 to -1100
 * Range code type error from -100 to -200
 */
enum EventResponseCodeEnums: int
{
    case EVENT_LIST = 1000;
    case EVENT_CREATED = 1001;
    case EVENT_UPDATED = 1002;
    case EVENT_DELETED = 1003;
    case NO_EVENT_FOUND = -100;
    case EVENT_DATA = 1005;

    private const METADATA = [
        self::EVENT_LIST->value => ['status' => 200, 'type' => 'data'],
        self::EVENT_CREATED->value => ['status' => 201, 'type' => 'success'],
        self::EVENT_UPDATED->value => ['status' =>200 , 'type' => 'success'],
        self::EVENT_DELETED->value => ['status' => 200, 'type' => 'success'],
        self::NO_EVENT_FOUND->value => ['status' => 404, 'type' => 'error'],
        self::EVENT_DATA->value => ['status' => 200, 'type' => 'data'],
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
            'message' => __('response_message.event.' . $this->name),
        ];
    }
}
