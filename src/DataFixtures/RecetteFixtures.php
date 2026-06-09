<?php

namespace App\DataFixtures;

use App\Entity\Activity;
use App\Entity\Category;
use App\Entity\Place;
use App\Entity\Recette;
use App\Entity\Season;
use App\Entity\Status;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;





class RecetteFixtures extends Fixture implements DependentFixtureInterface
{


    const RECETTE_REFERENCE = 'recette';

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
         //   $recette->setPublished($faker->boolean(chanceOfGettingTrue: 70));
            $categories = ['Dessert', 'Plat', 'Entrée'];
            $recette->setCategory($this->getReference(
                CategoryFixtures::CATEGORY_REFERENCE . $faker->randomElement($categories),
                Category::class
            ));

            $recette->setUser($this->getReference(
                UserFixtures::USER_REFERENCE . $faker->numberBetween(0, 100),
                User::class
            ));

            $seasons = ['Printemps', 'Été', 'Automne', 'Hiver'];
            $recette->setSeason($this->getReference(
                SeasonFixtures::SEASON_REFERENCE . $faker->randomElement($seasons),
                Season::class
            ));


            $recette->setActivity($this->getReference(
                ActivityFixtures::ACTIVITY_REFERENCE .  $faker->numberBetween(0, 4),
                Activity::class
            ));

            $places = ['Espace Bel Air', 'Centre de Loissirs', 'La Passerelle'];
            $recette->setPlace($this->getReference(
                PlaceFixtures::PLACE_REFERENCE . $faker->randomElement($places),
                Place::class
            ));

            $statuses = ['Publié', 'Brouillon', 'Archivé'];
            $recette->setStatus($this->getReference(
                StatusFixtures::STATUS_REFERENCE . $faker->randomElement($statuses),
                Status::class
            ));

            $dateCreated = $faker->dateTimeBetween('-1 year',"now");
            $recette->setDateCreated(\dateTimeImmutable::createFromMutable($dateCreated));

            $dateUpdate = $faker->dateTimeBetween($dateCreated,"now");
            $recette->setDateModified(\dateTimeImmutable::createFromMutable($dateUpdate));


            $this->addReference(self::RECETTE_REFERENCE . $i, $recette);




            //on subgarde
            $manager->persist($recette);
        }

        //on exécute
$manager->flush();
    }

    public function getDependencies(): array
    {
        return [CategoryFixtures::class,
                UserFixtures::class,
                SeasonFixtures::class,
                PlaceFixtures::class,
                ActivityFixtures::class,
                StatusFixtures::class,

        ];
    }
}
