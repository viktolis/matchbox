<?php

namespace App\Enum;

enum ConverterFormatEnum : string
{
    case XML = 'xml';
    case JSON = 'json';

    public static function casesValues(): array
    {
        return array_column(ConverterFormatEnum::cases(), 'value');
    }
}
