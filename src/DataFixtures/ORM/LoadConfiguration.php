<?php

namespace App\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Configuration;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class LoadConfiguration extends AbstractFixture implements DependentFixtureInterface
{
    
    public function load(ObjectManager $manager)
    {
    	$configuration1 = new Product;
        $configuration1->setColor('');
        $configuration1->setMemory('');
        $configuration1->setSerial('');
        $configuration1->setPrice('');
        $configuration1->setProduct($this->getReference('product1'));
        $manager->persist($configuration1);

        $configuration2 = new Product;
        $configuration2->setColor('');
        $configuration2->setMemory('');
        $configuration2->setSerial('');
        $configuration2->setPrice('');
        $configuration2->setProduct($this->getReference('product2'));
        $manager->persist($configuration2);
        $manager->flush();

        $configuration3 = new Product;
        $configuration3->setColor('');
        $configuration3->setMemory('');
        $configuration3->setSerial('');
        $configuration3->setPrice('');
        $configuration3->setProduct($this->getReference('product3'));
        $manager->persist($configuration3);

        $configuration4 = new Product;
        $configuration4->setColor('');
        $configuration4->setMemory('');
        $configuration4->setSerial('');
        $configuration4->setPrice('');
        $configuration4->setProduct($this->getReference('product4'));
        $manager->persist($configuration4);

        $configuration5 = new Product;
        $configuration5->setColor('');
        $configuration5->setMemory('');
        $configuration5->setSerial('');
        $configuration5->setPrice('');
        $configuration5->setProduct($this->getReference('product5'));
        $manager->persist($configuration5);

        $configuration6 = new Product;
        $configuration6->setColor('');
        $configuration6->setMemory('');
        $configuration6->setSerial('');
        $configuration6->setPrice('');
        $configuration6->setProduct($this->getReference('product6'));
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