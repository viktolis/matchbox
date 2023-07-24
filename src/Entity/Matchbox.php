<?php

namespace App\Entity;

use App\Enum\ColorEnum;
use App\Enum\SizeEnum;
use App\Repository\MatchboxRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MatchboxRepository::class)]
class Matchbox
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 15)]
    private ?ColorEnum $color = null;

    #[ORM\Column(length: 15)]
    private ?SizeEnum $size = null;

    #[ORM\Column]
    private ?int $matchesCount = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getColor(): ?ColorEnum
    {
        return $this->color;
    }

    public function setColor(ColorEnum $color): static
    {
        $this->color = $color;

        return $this;
    }

    public function getSize(): ?SizeEnum
    {
        return $this->size;
    }

    public function setSize(SizeEnum $size): static
    {
        $this->size = $size;

        return $this;
    }

    public function getMatchesCount(): ?int
    {
        return $this->matchesCount;
    }

    public function setMatchesCount(int $matchesCount): static
    {
        $this->matchesCount = $matchesCount;

        return $this;
    }

    public function burn(int $matchesToBurn = 1): self
    {
        if($this->matchesCount >= $matchesToBurn){
            $this->matchesCount -= $matchesToBurn;
        }

        return $this;
    }
}
