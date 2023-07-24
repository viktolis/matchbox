<?php

namespace App\Model\Interfaces;

use App\Enum\ConverterFormatEnum;

interface ConverterArgumentInterface
{
    public function getFormat(): ConverterFormatEnum;
    public function getPath(): string;
}