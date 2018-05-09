<?php

namespace App\DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Manufacturer;

class LoadManufacturer extends Fixture 
{   
    public function load(ObjectManager $manager)
    {
    	$manufacturer1 = new Manufacturer;
        $manufacturer1->setName('Samsung');
        $manager->persist($manufacturer1);

        $manufacturer2 = new Manufacturer;
        $manufacturer2->setName('Apple');
        $manager->persist($manufacturer2);

        $manager->flush();

        $this->addReference('manufacturer1', $manufacturer1);
        $this->addReference('manufacturer2', $manufacturer2);
    }
}