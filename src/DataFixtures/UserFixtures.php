<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use App\Entity\User;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;


class UserFixtures extends Fixture
{
    const USER_REFERENCE = 'user';
    private UserPasswordHasherInterface $passwordHasher;
    public function __construct(UserPasswordHasherInterface $passwordHasher){
        $this->passwordHasher = $passwordHasher;
    }

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr-FR');


        for($i=0; $i<50; $i++){
        $user = new User();
        $hashedPassword= $this->passwordHasher->hashPassword(
            $user,
            plainPassword: 'azerty'
        );


            $user->setFirstname($faker->firstName($faker->randomElement(['male','female'])))
            ->setUsername($faker->userName())
            ->setLastname($faker->lastName())
            ->setEmail($faker->email())
            ->setRoles($faker->randomElements(['ROLE_USER', 'ROLE_ADMIN']))
            ->setProfilePicture(null)
            ->setPassword($hashedPassword);


        $manager->persist($user);

            $this->addReference(self::USER_REFERENCE.$i, $user);


        }

        $manager->flush();
    }
}
