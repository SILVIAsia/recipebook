<?php

namespace App\DataFixtures;

use App\Entity\Ingredient;
use App\Entity\Recette;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class IngredientFixtures extends Fixture implements DependentFixtureInterface
{


    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        for ($i = 1; $i < 50; $i++) {
            $nbIngredients = $faker->numberBetween(3, 8);
            for ($j = 1; $j <= $nbIngredients; $j++) {
                $ingredient = new Ingredient();
                $ingredient->setName($faker->word())
                    ->setQuantity($faker->randomFloat(2, 1, 500))
                    ->setUnit($faker->randomElement(['g', 'kg', 'ml', 'L', 'cuillère', 'tasse']))
                    ->setRecette($this->getReference(
                        RecetteFixtures::RECETTE_REFERENCE . $i,
                        Recette::class
                    ));
                $manager->persist($ingredient);
            }
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [RecetteFixtures::class];
    }
}
