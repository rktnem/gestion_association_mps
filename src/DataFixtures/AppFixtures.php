<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\User;
use DateTimeImmutable;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    private $hasher;

    public function __construct(UserPasswordHasherInterface $hasher) {
        $this->hasher = $hasher;
    }

    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);
        $faker = Factory::create();

        for($i = 0; $i < 5; $i++) {
            $user = new User();

            $user->setEmail($faker->email);
            $user->setRoles([]);
            $user->setPassword($this->hasher->hashPassword($user, '0000'));
            $user->setName($faker->lastName);
            $user->setFirstname($faker->firstName);
            $user->setCreatedAt(new DateTimeImmutable);
            $user->setUpdatedAt(new DateTimeImmutable);

            $manager->persist($user);
        }
        
        $manager->flush();
    }
}