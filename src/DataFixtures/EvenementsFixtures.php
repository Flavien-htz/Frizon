<?php

namespace App\DataFixtures;

use App\Entity\Evenements;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;

class EvenementsFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        
        for ($i=0; $i < 20; $i++) { 

            $evenements = new Evenements();

            $faker = Faker\Factory::create();

            $evenements->setNom($faker->word())
                    ->setLieu($faker->text($maxNbChars = 40))
                    ->setDateDebut($faker->date($format = 'Y-m-d'))
                    ->setDateFin($faker->date($format = 'Y-m-d'));

        
            $manager->persist($evenements);
        }

        $manager->flush();
    }
}
