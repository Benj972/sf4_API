<?php

namespace App\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Manufacturer;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class LoadManufacturer extends AbstractFixture implements DependentFixtureInterface
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