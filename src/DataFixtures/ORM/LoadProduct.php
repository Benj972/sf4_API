<?php

namespace App\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Product;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class LoadProduct extends AbstractFixture implements DependentFixtureInterface
{
    
    public function load(ObjectManager $manager)
    {
    	$product1 = new Product;
        $product1->setName('');
        $product1->setSize('');
        $product1->setMultimedia('');
        $product1->setNetwork('');
        $product1->setScreen('');
        $product1->setAutonomy('');
        $product1->setDescription('');
        $product1->setDateCreate(new \DateTime('2018-05-09 09:35:36'));
        $product1->setManufacturer($this->getReference('manufacturer1'));
        $manager->persist($product1);

        $product2 = new Product;
        $product2->setName('');
        $product2->setSize('');
        $product2->setMultimedia('');
        $product2->setNetwork('');
        $product2->setScreen('');
        $product2->setAutonomy('');
        $product2->setDescription('');
        $product2->setDateCreate(new \DateTime('2018-05-09 09:35:36'));
        $product2->setManufacturer($this->getReference('manufacturer1'));
        $manager->persist($product2);

        $product3 = new Product;
        $product3->setName('');
        $product3->setSize('');
        $product3->setMultimedia('');
        $product3->setNetwork('');
        $product3->setScreen('');
        $product3->setAutonomy('');
        $product3->setDescription('');
        $product3->setDateCreate(new \DateTime('2018-05-09 09:35:36'));
        $product3->setManufacturer($this->getReference('manufacturer1'));
        $manager->persist($product3);

        $product4 = new Product;
        $product4->setName('');
        $product4->setSize('');
        $product4->setMultimedia('');
        $product4->setNetwork('');
        $product4->setScreen('');
        $product4->setAutonomy('');
        $product4->setDescription('');
        $product4->setDateCreate(new \DateTime('2018-05-09 09:35:36'));
        $product4->setManufacturer($this->getReference('manufacturer2'));
        $manager->persist($product4);

        $product5 = new Product;
        $product5->setName('');
        $product5->setSize('');
        $product5->setMultimedia('');
        $product5->setNetwork('');
        $product5->setScreen('');
        $product5->setAutonomy('');
        $product5->setDescription('');
        $product5->setDateCreate(new \DateTime('2018-05-09 09:35:36'));
        $product5->setManufacturer($this->getReference('manufacturer2'));
        $manager->persist($product5);

        $product6 = new Product;
        $product6->setName('');
        $product6->setSize('');
        $product6->setMultimedia('');
        $product6->setNetwork('');
        $product6->setScreen('');
        $product6->setAutonomy('');
        $product6->setDescription('');
        $product6->setDateCreate(new \DateTime('2018-05-09 09:35:36'));
        $product6->setManufacturer($this->getReference('manufacturer2'));
        $manager->persist($product6);

        $manager->flush();

        $this->addReference('product1', $product1);
        $this->addReference('product2', $product2);
        $this->addReference('product3', $product3);
        $this->addReference('product4', $product4);
        $this->addReference('product5', $product5);
        $this->addReference('product6', $product6);
    }

    public function getDependencies()
    {
        return array(
        LoadManufacturer::class,
        );
    }
}