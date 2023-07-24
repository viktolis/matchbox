<?php

namespace App\Services\Collector;

use App\Enum\ConverterTypeEnum;
use App\Model\Interfaces\ConverterInterface;
use RuntimeException;

class ConverterCollector
{
    protected array $converters = [];

    public function getConverter(ConverterTypeEnum $type): ConverterInterface
    {
        if(array_key_exists($type->value, $this->converters)){
            return $this->converters[$type->value];
        }

        throw new RuntimeException(
            sprintf(
                'Converter for type %s do not exist',
                $type->value
            )
        );
    }

    public function addConverter(ConverterInterface $converter): self
    {
        if(!array_key_exists($converter->getType()->value, $this->converters)){
            $this->converters[$converter->getType()->value] = $converter;

            return $this;
        }

        throw new RuntimeException(
            sprintf(
                'Converter type %s already exist, please rename type of %s for it\'s usage',
                $converter->getType()->value,
                get_class($converter)
            )
        );
    }
}