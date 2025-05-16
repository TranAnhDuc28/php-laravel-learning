<?php

namespace App\Traits;

trait LocalizedEnum
{
    public function getLocalizedName(): ?string
    {
        $localizedStringKey = 'enums.' . $this::class . '.' . $this->name;

        return __($localizedStringKey);
    }
}
