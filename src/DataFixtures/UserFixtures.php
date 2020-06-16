<?php

namespace App\DataFixtures;

use App\Entity\Users;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{
    
    private $password;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->password = $encoder;
    }

    public function load(ObjectManager $manager)
    {

        $user = new Users();

        $user->setUsername('demo')
            ->setPassword($this->password->encodePassword($user, 'demo'))
            ->setRoles([
                'ROLE_ADMIN'
            ]);

        $manager->persist($user);

        $manager->flush();
    }
}
