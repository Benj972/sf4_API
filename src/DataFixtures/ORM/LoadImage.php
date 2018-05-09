<?php

namespace App\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Image;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class LoadImage extends AbstractFixture implements DependentFixtureInterface
{
    
    public function load(ObjectManager $manager)
    {
    	$image1 = new Image;
        $image1->setUrl('');
        $image1->setAlt('');
        $image1->setProduct($this->getReference('product1'));
        $manager->persist($image1);

        $image2 = new Image;
        $image2->setUrl('');
        $image2->setAlt('');
        $image2->setProduct($this->getReference('product2'));
        $manager->persist($image2);

        $image3 = new Image;
        $image3->setUrl('');
        $image3->setAlt('');
        $image3->setProduct($this->getReference('product3'));
        $manager->persist($image3);

        $image4 = new Image;
        $image4->setUrl('');
        $image4->setAlt('');
        $image4->setProduct($this->getReference('product4'));
        $manager->persist($image4);

        $image5 = new Image;
        $image5->setUrl('');
        $image5->setAlt('');
        $image5->setProduct($this->getReference('product5'));
        $manager->persist($image5);

        $image6 = new Image;
        $image6->setUrl('');
        $image6->setAlt('');
        $image6->setProduct($this->getReference('product6'));
        $manager->persist($image6);

        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
        LoadProduct::class,
        );
    }
}