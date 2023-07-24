<?php

namespace App\Model\Interfaces;

use App\Enum\ConverterTypeEnum;

interface ConverterInterface
{
    public function getType(): ConverterTypeEnum;
    public function convert(ConverterArgumentInterface $argument): mixed;
}