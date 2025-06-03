<?php

namespace App\Dto;

class MonthlyPaymentRequestDto extends BaseDto
{
    public function __construct(

    )
    {
    }

    public static function fromArray(array $data): self
    {
        return new self(

        );
    }
}
