<?php

namespace App\Services\Serializer;

use App\Entity\Matchbox;
use App\Enum\ColorEnum;
use App\Enum\ConverterFormatEnum;
use App\Enum\SizeEnum;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Error;

class MatchboxSerializer implements NormalizerInterface, DenormalizerInterface
{
    public function __construct(readonly EntityManagerInterface $entityManager, readonly LoggerInterface $logger)
    {
    }

    public function normalize(mixed $object, string $format = null, array $context = []): array
    {
        return [
            'id'            => $object->getId(),
            'color'         => $object->getColor()->value,
            'size'          => $object->getSize()->value,
            'matchesCount'  => $object->getMatchesCount()
        ];
    }

    public function denormalize(mixed $data, string $type, string $format = null, array $context = []): mixed
    {
        $matchboxes = [];

        if(is_array($data)){
            foreach ($data as $key => $matchboxArray){
                if($matchbox = $this->denormalizeMatchbox($matchboxArray, $key)){
                    $matchboxes[] = $matchbox;
                }
            }
        } else {
            if($matchbox = $this->denormalizeMatchbox($data)){
                $matchboxes[] = $matchbox;
            }
        }

        return $matchboxes;
    }

    protected function denormalizeMatchbox(array $data, int $line = 0): ?Matchbox
    {
        try{
            if(array_key_exists('id', $data)){
                $matchbox = $this->entityManager->getRepository(Matchbox::class)->find($data['id']) ?: new Matchbox();
            } else {
                $matchbox = new Matchbox();
            }

            return $matchbox
                ->setColor(ColorEnum::tryFrom($data['color']))
                ->setSize(SizeEnum::tryFrom($data['size']))
                ->setMatchesCount($data['matchesCount'])
                ;
        } catch(Error $exception){
            $this->logger->critical(sprintf('Error on line %s - %s', $line, $exception->getMessage()));

            return null;
        }
    }

    public function supportsDenormalization(mixed $data, string $type, string $format = null): bool
    {
        return $this->serializationRules($type, $format);
    }

    public function supportsNormalization(mixed $data, string $format = null): bool
    {
        return $this->serializationRules(get_class($data), $format);
    }

    public function getSupportedTypes(?string $format): array
    {
        return [Matchbox::class => false];
    }

    protected function serializationRules(string $className, string $format): bool
    {
        return $className === Matchbox::class && in_array($format, ConverterFormatEnum::casesValues());
    }
}