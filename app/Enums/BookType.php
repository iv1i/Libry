<?php

namespace App\Enums;

enum BookType: string
{
    case GRAPHIC = 'graphic';
    case DIGITAL = 'digital';
    case PRINTED = 'printed';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
