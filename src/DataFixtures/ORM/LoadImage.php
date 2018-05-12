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
        $image1->setConfiguration($this->getReference('configuration1'));
        $manager->persist($image1);

        $image2 = new Image;
        $image2->setUrl('http://mobile.free.fr/fiche_mobile/samsung/galaxy_note8/noir/images/1.jpg');
        $image2->setAlt('Galaxy Note 8');
        $image2->setConfiguration($this->getReference('configuration2'));
        $manager->persist($image2);

        $image3 = new Image;
        $image3->setUrl('http://mobile.free.fr/fiche_mobile/apple/iPhone_8_Plus/grisSideral/256go/images/1.jpg');
        $image3->setAlt('iPhone 8 Plus');
        $image3->setConfiguration($this->getReference('configuration3'));
        $manager->persist($image3);

        $image4 = new Image;
        $image4->setUrl('http://mobile.free.fr/fiche_mobile/apple/iPhone_8/argent/256go/images/1.jpg');
        $image4->setAlt('iPhone 8 Plus');
        $image4->setConfiguration($this->getReference('configuration4'));
        $manager->persist($image4);

        $image5 = new Image;
        $image5->setUrl('http://mobile.free.fr/fiche_mobile/apple/iPhone_8_Plus/or/64go/images/1.jpg');
        $image5->setAlt('iPhone 8 Plus');
        $image5->setConfiguration($this->getReference('configuration5'));
        $manager->persist($image5);

        $image6 = new Image;
        $image6->setUrl('http://mobile.free.fr/fiche_mobile/apple/iPhone_8_Plus/grisSideral/64go/images/1.jpg');
        $image6->setAlt('iPhone 8 Plus');
        $image6->setConfiguration($this->getReference('configuration6'));
        $manager->persist($image6);

        $image7 = new Image;
        $image7->setUrl('http://mobile.free.fr/fiche_mobile/samsung/galaxy_S9_Plus/violet/images/1.jpg');
        $image7->setAlt('Galaxy S9');
        $image7->setConfiguration($this->getReference('configuration7'));
        $manager->persist($image7);

        $image8 = new Image;
        $image8->setUrl('http://mobile.free.fr/fiche_mobile/samsung/galaxy_S9_Plus/bleu/images/1.jpg');
        $image8->setAlt('Galaxy S9');
        $image8->setConfiguration($this->getReference('configuration8'));
        $manager->persist($image8);

        $image9 = new Image;
        $image9->setUrl('http://mobile.free.fr/fiche_mobile/apple/iPhone_8/rouge/64go/images/1.jpg');
        $image9->setAlt('iPhone 8');
        $image9->setConfiguration($this->getReference('configuration9'));
        $manager->persist($image9);

        $image10 = new Image;
        $image10->setUrl('http://mobile.free.fr/fiche_mobile/samsung/galaxy_S8_Plus/noirCarbone/images/1.jpg');
        $image10->setAlt('Galaxy S8 +');
        $image10->setConfiguration($this->getReference('configuration10'));
        $manager->persist($image10);

        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
        LoadConfiguration::class,
        );
    }
}