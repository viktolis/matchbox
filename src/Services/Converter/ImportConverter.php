<?php

namespace App\Services\Converter;

use App\Entity\Matchbox;
use App\Enum\ConverterTypeEnum;
use App\Model\Interfaces\ConverterArgumentInterface;
use Symfony\Component\Finder\SplFileInfo;

class ImportConverter extends Converter
{
    public function getType(): ConverterTypeEnum
    {
        return ConverterTypeEnum::Import;
    }

    public function convert(ConverterArgumentInterface $argument): mixed
    {
        $file = new SplFileInfo($argument->getPath(), '', '');
        $matchboxes = $this->serializer->deserialize($file->getContents(), Matchbox::class, $argument->getFormat()->value);

        foreach ($matchboxes as $matchbox){
            $this->entityManager->persist($matchbox);
            $this->entityManager->flush();
        }

        return null;
    }
}