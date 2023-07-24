<?php

namespace App\DataFixtures;

use App\Entity\Matchbox;
use App\Enum\ColorEnum;
use App\Enum\SizeEnum;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $matchbox = $this->createMatchbox(SizeEnum::Big, ColorEnum::Blue, 20);
        $manager->persist($matchbox);

        $matchbox1 = $this->createMatchbox(SizeEnum::Normal, ColorEnum::Red, 45);
        $manager->persist($matchbox1);

        $matchbox2 = $this->createMatchbox(SizeEnum::Small, ColorEnum::White, 95);
        $manager->persist($matchbox2);

        $matchbox3 = $this->createMatchbox(SizeEnum::Big, ColorEnum::Orange, 50);
        $manager->persist($matchbox3);

        $matchbox4 = $this->createMatchbox(SizeEnum::Small, ColorEnum::Blue, 43);
        $manager->persist($matchbox4);

        $manager->flush();
    }

    protected function createMatchbox(SizeEnum $size, ColorEnum $color, int $matchesCount): Matchbox
    {
        $matchbox = new Matchbox();
        $matchbox
            ->setSize($size)
            ->setColor($color)
            ->setMatchesCount($matchesCount)
        ;

        return $matchbox;
    }
}
