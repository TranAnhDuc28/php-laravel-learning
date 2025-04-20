<?php

namespace App\Dto;

class EventDto
{
    public function __construct(
        public int $id,
        public string $title,
        public string $start,
        public ?string $end,
        public bool $allDay,
        public ?string $className,
        public ?string $location,
        public ?string $description
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            id: $data['id'],
            title: $data['title'],
            start: $data['start'],
            end: $data['end'] ?? null,
            allDay: $data['allDay'] ?? false,
            className: $data['className'] ?? null,
            location: $data['location'] ?? null,
            description: $data['description'] ?? null
        );
    }

    public function toArray(): array
    {
        $array = [
            'id' => $this->id,
            'title' => $this->title,
            'start' => $this->start,
            'end' => $this->end,
            'allDay' => $this->allDay,
            'className' => $this->className,
            'location' => $this->location,
            'description' => $this->description
        ];

        // Remove null values
        return array_filter($array, function ($value) {
            return $value !== null;
        });
    }
} 