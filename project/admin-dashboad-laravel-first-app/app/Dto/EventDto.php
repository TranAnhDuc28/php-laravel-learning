<?php

namespace App\Dto;

use App\Enums\EventType;

class EventDto extends BaseDto
{
    public function __construct(
        public int     $id,
        public string  $type,
        public string  $title,
        public string  $start,
        public ?string $end,
        public bool    $allDay,
        public ?string $url,
        public string  $classNames,
        public ?string $location,
        public ?string $department,
        public ?string $description,
    )
    {}

    public static function fromArray(array $data): self
    {
        $eventType = EventType::fromValue($data['type']);

        return new self(
            $data['id'],
            $data['type'],
            $data['title'],
            $data['start'],
            $data['end'],
            $data['all_day'],
            $data['url'],
            $eventType?->className() ?? 'bg-info-subtle',
            $data['location'],
            $data['department'],
            $data['description']
        );
    }
}
