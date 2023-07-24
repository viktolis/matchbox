<?php

namespace App\Services\Converter;

use App\Entity\Matchbox;
use App\Enum\ConverterTypeEnum;
use App\Model\Interfaces\ConverterArgumentInterface;
use DateTime;
use Symfony\Component\Filesystem\Filesystem;

class ExportConverter extends Converter
{
    public function getType(): ConverterTypeEnum
    {
        return ConverterTypeEnum::Export;
    }

    public function convert(ConverterArgumentInterface $argument): mixed
    {
        $now = new DateTime();
        $matchboxes = $this->entityManager->getRepository(Matchbox::class)->findAll();
        $filesystem = new Filesystem();

        $filesystem->dumpFile(
            sprintf('%s/matchboxes-%s.%s', $argument->getPath(), $now->format('Ymdhis'), $argument->getFormat()->value),
            $this->serializer->serialize($matchboxes, $argument->getFormat()->value)
        );

        return null;
    }
}