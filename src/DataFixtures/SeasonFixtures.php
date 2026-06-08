<?php

namespace App\DataFixtures;

use App\Entity\Season;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class SeasonFixtures extends Fixture
{
    public const SEASON_REFERENCE = 'season';

    public function load(ObjectManager $manager): void
    {
        foreach (['Printemps', 'Été', 'Automne', 'Hiver'] as $value) {
            $season = new Season();
            $season->setNameSeason($value);
            $manager->persist($season);
            $this->addReference(self::SEASON_REFERENCE . $value, $season);
        }

        $manager->flush();
    }
}
