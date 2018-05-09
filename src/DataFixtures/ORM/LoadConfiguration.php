<?php

namespace App\DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Configuration;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class LoadConfiguration extends Fixture implements DependentFixtureInterface
{
    
    public function load(ObjectManager $manager)
    {
    	$configuration1 = new Configuration;
        $configuration1->setColor('Gris Sidéral');
        $configuration1->setMemory('256Go');
        $configuration1->setSerial('api1');
        $configuration1->setPrice('1400');
        $configuration1->setProduct($this->getReference('product1'));
        $manager->persist($configuration1);

        $configuration2 = new Configuration;
        $configuration2->setColor('Noir');
        $configuration2->setMemory('64Go');
        $configuration2->setSerial('api2');
        $configuration2->setPrice('1000');
        $configuration2->setProduct($this->getReference('product2'));
        $manager->persist($configuration2);
        $manager->flush();

        $configuration3 = new Configuration;
        $configuration3->setColor('Gris Sidéral');
        $configuration3->setMemory('256Go');
        $configuration3->setSerial('api3');
        $configuration3->setPrice('1200');
        $configuration3->setProduct($this->getReference('product3'));
        $manager->persist($configuration3);

        $configuration4 = new Configuration;
        $configuration4->setColor('Argent');
        $configuration4->setMemory('256Go');
        $configuration4->setSerial('api4');
        $configuration4->setPrice('1200');
        $configuration4->setProduct($this->getReference('product3'));
        $manager->persist($configuration4);

        $configuration5 = new Configuration;
        $configuration5->setColor('Or');
        $configuration5->setMemory('64Go');
        $configuration5->setSerial('api5');
        $configuration5->setPrice('950');
        $configuration5->setProduct($this->getReference('product3'));
        $manager->persist($configuration5);

        $configuration6 = new Configuration;
        $configuration6->setColor('Gris Sidéral');
        $configuration6->setMemory('64Go');
        $configuration6->setSerial('api6');
        $configuration6->setPrice('950');
        $configuration6->setProduct($this->getReference('product3'));
        $manager->persist($configuration6);

        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
        LoadProduct::class,
        );
    }
}