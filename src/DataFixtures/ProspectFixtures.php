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

        $manager->flush();
    }
}
