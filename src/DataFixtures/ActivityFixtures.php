<?php

namespace App\DataFixtures;

use App\Entity\Activity;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class ActivityFixtures extends Fixture
{
    public const ACTIVITY_REFERENCE = 'activity';

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');


        for ($i = 0; $i < 5; $i++) {
            $activity = new Activity();
            $activity->setNameActivity($faker->sentence(3));
            $manager->persist($activity);
            $this->addReference(self::ACTIVITY_REFERENCE . $i, $activity);
        }

        $manager->flush();
    }
}
