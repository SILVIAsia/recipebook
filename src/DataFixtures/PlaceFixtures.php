<?php

namespace App\DataFixtures;

use App\Entity\Place;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class PlaceFixtures extends Fixture
{
    public const PLACE_REFERENCE = 'place';
    public function load(ObjectManager $manager): void
    {
        foreach (['Espace Bel Air', 'Centre de Loissirs', 'La Passerelle'] as $value) {
            $place = new Place();
            $place->setNamePlace($value);
            $manager->persist($place);
            $this->addReference(self::PLACE_REFERENCE . $value, $place);
        }

        $manager->flush();
    }
}

