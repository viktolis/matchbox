<?php

namespace App\Enum;

enum ConverterTypeEnum: string
{
    case Import = 'import';
    case Export = 'export';
}