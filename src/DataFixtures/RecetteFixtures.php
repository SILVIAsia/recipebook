<?php

namespace App\DataFixtures;

use App\Entity\Recette;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class RecetteFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        //Crea una instancia de Faker — es como "arrancar" el generador de datos falsos.
        $faker =\Faker\Factory::create('fr_FR');

        //crée 50 recettes!
        for ($i = 1; $i < 50; $i++) {

            //crée une instance vide
            $recette = new Recette();
            // on l'hydrate
            $recette->setTitre($faker->sentence());
            $recette->setDescription($faker->paragraph());
            $recette->setPreparationTime($faker->numberBetween(30, 60));
            $recette->setCooktime($faker->numberBetween(30, 60));
            $recette->setServings($faker->numberBetween(1, 60));

            $recette->setDate(\DateTimeImmutable::createFromMutable($faker->dateTime()));
            $recette->setDifficulty($faker->numberBetween(1, 3));
            $recette->setProducer($faker->name());
            $recette->setPublished($faker->boolean(chanceOfGettingTrue: 70));

            $dateCreated = $faker->dateTimeBetween('-1 year',"now");
            $recette->setDateCreated(\dateTimeImmutable::createFromMutable($dateCreated));

            $dateUpdate = $faker->dateTimeBetween($dateCreated,"now");
            $recette->setDateModified(\dateTimeImmutable::createFromMutable($dateUpdate));


            //on subgarde
            $manager->persist($recette);
        }

        //on exécute
$manager->flush();
    }
}
