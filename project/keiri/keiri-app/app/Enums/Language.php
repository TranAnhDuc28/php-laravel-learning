<?php

namespace App\Enums;

use Illuminate\Support\Facades\App;

enum Language: string
{
    case English = 'en';

    case Japanese = 'ja';

    public static function getCurrent()
    {
        $currentLanguage = self::tryFrom(App::getLocale());
        if ($currentLanguage) {
            return $currentLanguage;
        }
        return self::English;
    }

    public function getNativeName(): string
    {
        switch ($this) {
            case self::English:
                return 'English';
            case self::Japanese:
                return '日本語';
        }
    }
}
