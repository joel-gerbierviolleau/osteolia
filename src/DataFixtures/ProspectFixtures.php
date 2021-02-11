<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Prospect;

class ProspectFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {

    	$prospectNotOKToBeContacted = new Prospect();
    	$prospectNotOKToBeContacted
    		->setFirstName('Eve')
    		->setLastName('Not OK')
    		->setEmail('eve_not_ok@osteolia.com')
    		->setIsOkToBeContacted(false);

    	$prospectOKToBeContactedFull = new Prospect();
    	$prospectOKToBeContactedFull
    		->setFirstName('Aline')
    		->setLastName('OK and its great')
    		->setEmail('aline_is_ok@osteolia.com')
    		->setIsOkToBeContacted(true)
    		->setphoneNumber('0612345678')
    		->setSchool('Coolège Osteopathique de Bordeaux')
    		->setYearsOfPractice(0);

    	$prospectOKToBeContactedIinternationalPhoneAndSchool = new Prospect();
    	$prospectOKToBeContactedIinternationalPhoneAndSchool
    		->setFirstName('Gauthier')
    		->setLastName('OK but phone only')
    		->setEmail('gauthier_international_longemail@osteolia.com')
    		->setIsOkToBeContacted(true)
    		->setphoneNumber('+33 6 12 34 56 78')
    		->setSchool('IOP')
    		->setYearsOfPractice(null);

    	$prospectOKToBeContactedExpandedPhoneLongSchoolAndAbove5YoP = new Prospect();
    	$prospectOKToBeContactedExpandedPhoneLongSchoolAndAbove5YoP
    		->setFirstName('Cyrano Savinien Hercule')
    		->setLastName('De Bergerac')
    		->setEmail('aline_is_ok@osteolia.com')
    		->setIsOkToBeContacted(true)
    		->setphoneNumber('06 12 34 56 78')
    		->setSchool('Coolège Internationnal Osteopathique de Bruxelles en Flandres')
    		->setYearsOfPractice(6);

    	$manager->persist($prospectNotOKToBeContacted);
    	$manager->persist($prospectOKToBeContactedFull);
    	$manager->persist($prospectOKToBeContactedIinternationalPhoneAndSchool);
    	$manager->persist($prospectOKToBeContactedExpandedPhoneLongSchoolAndAbove5YoP);

                $prospect5 = new Prospect();
        $prospect5
            ->setFirstName('prospect5')
            ->setLastName('Not OK')
            ->setEmail('prospect5@osteolia.com')
            ->setIsOkToBeContacted(false);
        $manager->persist($prospect5);

                $prospect6 = new Prospect();
        $prospect6
            ->setFirstName('prospect6')
            ->setLastName('Not OK')
            ->setEmail('prospect6@osteolia.com')
            ->setIsOkToBeContacted(false);
        $manager->persist($prospect6);

                $prospect7 = new Prospect();
        $prospect7
            ->setFirstName('prospect7')
            ->setLastName('Not OK')
            ->setEmail('prospect7@osteolia.com')
            ->setIsOkToBeContacted(false);
        $manager->persist($prospect7);

                $prospect8 = new Prospect();
        $prospect8
            ->setFirstName('prospect8')
            ->setLastName('Not OK')
            ->setEmail('prospect8@osteolia.com')
            ->setIsOkToBeContacted(false);
        $manager->persist($prospect8);

                $prospect9 = new Prospect();
        $prospect9
            ->setFirstName('prospect9')
            ->setLastName('Not OK')
            ->setEmail('prospect9@osteolia.com')
            ->setIsOkToBeContacted(false);
        $manager->persist($prospect9);

                $prospect10 = new Prospect();
        $prospect10
            ->setFirstName('prospect10')
            ->setLastName('Not OK')
            ->setEmail('prospect10@osteolia.com')
            ->setIsOkToBeContacted(false);
        $manager->persist($prospect10);

                $prospect11 = new Prospect();
        $prospect11
            ->setFirstName('prospect11')
            ->setLastName('Not OK')
            ->setEmail('prospect11@osteolia.com')
            ->setIsOkToBeContacted(false);
        $manager->persist($prospect11);

                $prospect12 = new Prospect();
        $prospect12
            ->setFirstName('prospect12')
            ->setLastName('Not OK')
            ->setEmail('prospect12@osteolia.com')
            ->setIsOkToBeContacted(false);
        $manager->persist($prospect12);


        $manager->flush();
    }
}
