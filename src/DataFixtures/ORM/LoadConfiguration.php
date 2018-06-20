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
        $configuration1 = new Configuration();
        $configuration1->setColor('Gris Sidéral');
        $configuration1->setMemory('256Go');
        $configuration1->setSerial('api1');
        $configuration1->setPrice('1400');
        $configuration1->setProduct($this->getReference('product1'));
        $manager->persist($configuration1);

        $configuration2 = new Configuration();
        $configuration2->setColor('Noir');
        $configuration2->setMemory('64Go');
        $configuration2->setSerial('api2');
        $configuration2->setPrice('1000');
        $configuration2->setProduct($this->getReference('product2'));
        $manager->persist($configuration2);
        $manager->flush();

        $configuration3 = new Configuration();
        $configuration3->setColor('Gris Sidéral');
        $configuration3->setMemory('256Go');
        $configuration3->setSerial('api3');
        $configuration3->setPrice('1200');
        $configuration3->setProduct($this->getReference('product3'));
        $manager->persist($configuration3);

        $configuration4 = new Configuration();
        $configuration4->setColor('Argent');
        $configuration4->setMemory('256Go');
        $configuration4->setSerial('api4');
        $configuration4->setPrice('1200');
        $configuration4->setProduct($this->getReference('product3'));
        $manager->persist($configuration4);

        $configuration5 = new Configuration();
        $configuration5->setColor('Or');
        $configuration5->setMemory('64Go');
        $configuration5->setSerial('api5');
        $configuration5->setPrice('950');
        $configuration5->setProduct($this->getReference('product3'));
        $manager->persist($configuration5);

        $configuration6 = new Configuration();
        $configuration6->setColor('Gris Sidéral');
        $configuration6->setMemory('64Go');
        $configuration6->setSerial('api6');
        $configuration6->setPrice('950');
        $configuration6->setProduct($this->getReference('product3'));
        $manager->persist($configuration6);

        $configuration7 = new Configuration();
        $configuration7->setColor('Ultra Violet');
        $configuration7->setMemory('64Go');
        $configuration7->setSerial('api7');
        $configuration7->setPrice('850,99');
        $configuration7->setProduct($this->getReference('product4'));
        $manager->persist($configuration7);

        $configuration8 = new Configuration();
        $configuration8->setColor('Bleu Corail');
        $configuration8->setMemory('64Go');
        $configuration8->setSerial('api8');
        $configuration8->setPrice('850,99');
        $configuration8->setProduct($this->getReference('product4'));
        $manager->persist($configuration8);

        $configuration9 = new Configuration();
        $configuration9->setColor('Rouge');
        $configuration9->setMemory('64Go');
        $configuration9->setSerial('api9');
        $configuration9->setPrice('800,99');
        $configuration9->setProduct($this->getReference('product5'));
        $manager->persist($configuration9);

        $configuration10 = new Configuration();
        $configuration10->setColor('Noir carbone');
        $configuration10->setMemory('64Go');
        $configuration10->setSerial('api10');
        $configuration10->setPrice('750,99');
        $configuration10->setProduct($this->getReference('product6'));
        $manager->persist($configuration10);

        $manager->flush();

        $this->addReference('configuration1', $configuration1);
        $this->addReference('configuration2', $configuration2);
        $this->addReference('configuration3', $configuration3);
        $this->addReference('configuration4', $configuration4);
        $this->addReference('configuration5', $configuration5);
        $this->addReference('configuration6', $configuration6);
        $this->addReference('configuration7', $configuration7);
        $this->addReference('configuration8', $configuration8);
        $this->addReference('configuration9', $configuration9);
        $this->addReference('configuration10', $configuration10);
    }

    public function getDependencies()
    {
        return [
        LoadProduct::class,
        ];
    }
}
