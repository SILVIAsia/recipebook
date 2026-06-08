<?php

namespace App\DataFixtures;

use App\Entity\Step;
use App\Entity\Recette;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class StepFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        for ($i = 1; $i < 50; $i++) {
            $nbSteps = $faker->numberBetween(3, 8);
            for ($j = 1; $j <= $nbSteps; $j++) {
                $step = new Step();
                $step->setNumber($j)
                    ->setDescription($faker->paragraph())
                    ->setRecette($this->getReference(
                        RecetteFixtures::RECETTE_REFERENCE . $i,
                        Recette::class
                    ));
                $manager->persist($step);
            }
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [RecetteFixtures::class];
    }
}
