<?php

namespace App\Model;

use App\Enum\ConverterFormatEnum;
use App\Model\Interfaces\ConverterArgumentInterface;

class ConverterArgument implements ConverterArgumentInterface
{
    public function __construct(readonly string $path, readonly ConverterFormatEnum $format)
    {
    }

    public function getPath(): string
    {
        return $this->path;
    }

    public function getFormat(): ConverterFormatEnum
    {
        return $this->format;
    }
}