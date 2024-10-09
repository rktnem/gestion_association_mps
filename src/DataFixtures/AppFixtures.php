<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\User;
use DateTimeImmutable;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);
        $faker = Factory::create();

        for($i = 0; $i < 5; $i++) {
            $user = new User();

            $user->setName($faker->lastName);
            $user->setFirstname($faker->firstName);
            $user->setEmail($faker->email);
            $user->setCreatedAt(new DateTimeImmutable);
            $user->setUpdatedAt(new DateTimeImmutable);

            $manager->persist($user);
        }
        
        $manager->flush();
    }
}