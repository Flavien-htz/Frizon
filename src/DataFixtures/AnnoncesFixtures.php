<?php

namespace App\DataFixtures;

use App\Entity\Annonces;
use App\Entity\Picture;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;

class AnnoncesFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {

        $faker = Faker\Factory::create('fr_FR');



        for ($i = 0; $i < 20; $i++) {
            $annonces = new Annonces();

            $annonces->setType($faker->word)
                ->setDescription($faker->text(144))
                ->setNomPersonne($faker->name())
                ->setCreatedAt(new \DateTime())
                ->setTelephone($faker->mobileNumber());


            $manager->persist($annonces);


            //Ajout des images à des annonces
            for ($j=0; $j < mt_rand(3, 4) ; $j++) {
                $pictures = new Picture();

                $pictures->setFilename($faker->imageUrl())
                        ->setAnnonces($annonces);

                $manager->persist($pictures);
            }

        }

        $manager->flush();
    }
}
