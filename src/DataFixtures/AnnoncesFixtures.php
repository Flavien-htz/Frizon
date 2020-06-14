<?php

namespace App\DataFixtures;

use App\Entity\Annonces;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;

class AnnoncesFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for ($i=0; $i < 20; $i++) {

            $faker = Faker\Factory::create('fr_FR');

            
            $annonces = new Annonces();


            

            $annonces->setType($faker->word)
                    ->setDescription($faker->text(144))
                    ->setNomPersonne($faker->lastName())
                    ->setCreatedAt($faker->dateTime($max = 'now', $timezone = null))
                    ->setTelephone($faker->e164PhoneNumber());



            $manager->persist($annonces);

        }

        $manager->flush();
    }
}