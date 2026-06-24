<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    const USER_REFERENCE = 'admin';

    public function __construct(private UserPasswordHasherInterface $passwordHasher) {}

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr-FR');
        for ($i = 0; $i < 20; $i++) {
            $user = new User();
            $hashedPassword = $this->passwordHasher->hashPassword($user, 'azerty');

            $user->setName($faker->firstName())
                ->setLastname($faker->lastName())
                ->setUsername($faker->userName())
                ->setEmail($faker->email())
                ->setRoles(["ROLE_USER"])
                ->setPhotouser(null)
                ->setPassword($hashedPassword);
            $manager->persist($user);
            $this->addReference(self::USER_REFERENCE . $i, $user);
        }

        $usertest = new User();
        $usertest->setName('UserTest')
            ->setLastname('UserTest')
            ->setUsername('UserTest')
            ->setEmail('test@test.com')
            ->setRoles(['ROLE_User'])
            ->setPhotouser(null)
            ->setPassword($this->passwordHasher->hashPassword($usertest, 'usertest123'));

        $manager->persist($usertest);

        $admin = new User();
        $admin->setName('Admin')
            ->setLastname('Admin')
            ->setUsername('admin')
            ->setEmail('silvia@admin.com')
            ->setRoles(['ROLE_ADMIN'])
            ->setPhotouser(null)
            ->setPassword($this->passwordHasher->hashPassword($admin, 'admin123'));

        $manager->persist($admin);

        $manager->flush();
    }
}
