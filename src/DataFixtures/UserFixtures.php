<?php

namespace App\DataFixtures;

use App\Entity\Users;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;


class UserFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {

        $faker = Faker\Factory::create('fr_FR');

        $user = new Users();

        $user->setUsername($faker->word())
            ->setPassword(
            $faker->word()
            );

        $manager->persist($user);

        $manager->flush();
    }
}
