<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CategoryFixtures extends Fixture
{
    public const CATEGORY_REFERENCE = 'category';
    public function load(ObjectManager $manager): void
    {

        foreach (['Dessert', 'Plat', 'Entrée'] as $value) {

            $category = new Category();
            $category->setNameCategory($value);
            $manager->persist($category);
        $this->addReference(self::CATEGORY_REFERENCE.$value, $category);

        }

        $manager->flush();
    }
}
