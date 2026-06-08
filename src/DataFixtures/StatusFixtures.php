<?php

namespace App\DataFixtures;

use App\Entity\Status;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class StatusFixtures extends Fixture
{
    public const STATUS_REFERENCE = 'status';

    public function load(ObjectManager $manager): void
    {
        foreach (['Publié', 'Brouillon', 'Archivé'] as $value) {
            $status = new Status();
            $status->setNameStatus($value);
            $manager->persist($status);
            $this->addReference(self::STATUS_REFERENCE . $value, $status);
        }

        $manager->flush();
    }
}
