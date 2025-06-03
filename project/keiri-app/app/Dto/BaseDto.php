<?php

namespace App\Dto;

abstract class BaseDto
{
    public static function fromArray(array $data): self
    {
        return new static(...$data);
    }
}
