<?php

namespace App\DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Image;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class LoadImage extends Fixture implements DependentFixtureInterface
{
    
    public function load(ObjectManager $manager)
    {
    	$image1 = new Image;
        $image1->setUrl('http://mobile.free.fr/fiche_mobile/apple/iPhone_X/grisSideral/256go/images/1.jpg');
        $image1->setAlt('I Phone X');
        $image1->setProduct($this->getReference('product1'));
        $manager->persist($image1);

        $image2 = new Image;
        $image2->setUrl('http://mobile.free.fr/fiche_mobile/samsung/galaxy_note8/noir/images/1.jpg');
        $image2->setAlt('Galaxy Note 8');
        $image2->setProduct($this->getReference('product2'));
        $manager->persist($image2);

        $image3 = new Image;
        $image3->setUrl('http://mobile.free.fr/fiche_mobile/apple/iPhone_8_Plus/grisSideral/256go/images/1.jpg');
        $image3->setAlt('iPhone 8 Plus');
        $image3->setProduct($this->getReference('product3'));
        $manager->persist($image3);

        $image4 = new Image;
        $image4->setUrl('http://mobile.free.fr/fiche_mobile/apple/iPhone_8/argent/256go/images/1.jpg');
        $image4->setAlt('iPhone 8 Plus');
        $image4->setProduct($this->getReference('product3'));
        $manager->persist($image4);

        $image5 = new Image;
        $image5->setUrl('http://mobile.free.fr/fiche_mobile/apple/iPhone_8_Plus/or/64go/images/1.jpg');
        $image5->setAlt('iPhone 8 Plus');
        $image5->setProduct($this->getReference('product3'));
        $manager->persist($image5);

        $image6 = new Image;
        $image6->setUrl('http://mobile.free.fr/fiche_mobile/apple/iPhone_8_Plus/grisSideral/64go/images/1.jpg');
        $image6->setAlt('iPhone 8 Plus');
        $image6->setProduct($this->getReference('product3'));
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