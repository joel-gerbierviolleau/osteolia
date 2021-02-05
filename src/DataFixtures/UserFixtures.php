<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\User;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


class UserFixtures extends Fixture
{

     private $passwordEncoder;

     public function __construct(UserPasswordEncoderInterface $passwordEncoder)
     {
         $this->passwordEncoder = $passwordEncoder;
     }


    public function load(ObjectManager $manager)
    {
    	// create dummy admin User
    	$adminUser = new User();
    	$adminUser
    		->setFirstName('Albert')
    		->setLastName('The Administrator')
    		->setEmail('albert@osteolia.com')
    		->setPassword($this->passwordEncoder->encodePassword(
	             $adminUser,
	             'albert'
         	))
         	->setRoles(['ROLE_ADMIN']);

        $manager->persist($adminUser);

        // create new dummy customer
    	$user = new User();
    	$user
    		->setFirstName('Oliver')
    		->setLastName('The Osteopath')
    		->setEmail('oliver@osteolia.com')
    		->setPassword($this->passwordEncoder->encodePassword(
	             $user,
	             'oliver'
         	))
         	->setRoles(['ROLE_USER']);

        $manager->persist($user);

        $manager->flush();
    }
}
