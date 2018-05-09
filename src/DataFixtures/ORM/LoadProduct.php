<?php

namespace App\DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Product;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class LoadProduct extends Fixture implements DependentFixtureInterface
{
    
    public function load(ObjectManager $manager)
    {
    	$product1 = new Product;
        $product1->setName('I Phone X');
        $product1->setSize(' 143.6 x 70.9 x 7.7 mm');
        $product1->setMultimedia('Caméra principale:12 mégapixels');
        $product1->setNetworks('Bluetooth 5.0, Wi-Fi 802.11ac, 4G');
        $product1->setScreen('5.8 pouces');
        $product1->setAutonomy('Jusqu\'à 21 heures');
        $product1->setDescription('L’iPhone X, c’est un design tout écran intégrant un écran Super Retina HD 5,8 pouces avec HDR et affichage True Tone. Paré du verre le plus résistant jamais conçu pour un smartphone et d’un contour plus solide en acier inoxydable chirurgical, il se charge sans fil et résiste à l’eau et à la poussière. Il intègre un double appareil photo 12 Mpx avec double stabilisation optique de l’image pour de superbes photos, même en conditions de faible éclairage, et une caméra TrueDepth avec le mode Portrait pour les selfies et la nouvelle fonctionnalité Éclairage de portrait. Face ID vous permet de déverrouiller votre appareil et d’utiliser Apple Pay d’un simple regard. Il est piloté par A11 Bionic, la puce la plus puissante et la plus intelligente jamais vue sur un smartphone. Et il prend en charge les expériences de réalité augmentée dans les apps et les jeux. Avec l’iPhone X, l’iPhone entame une nouvelle ère.');
        $product1->setDateCreate(new \DateTime('2018-05-09 09:35:36'));
        $product1->setManufacturer($this->getReference('manufacturer2'));
        $manager->persist($product1);

        $product2 = new Product;
        $product2->setName('Galaxy Note 8');
        $product2->setSize('162.5 x 74.6 x 8.5 mm');
        $product2->setMultimedia('Caméra principale : 12 mégapixels');
        $product2->setNetworks('Wi-Fi 802.11	a, b, g, n, ac ; Bluetooth 5.0; 4G FDD');
        $product2->setScreen('6.3 pouces');
        $product2->setAutonomy('24 heures');
        $product2->setDescription('Le Samsung Galaxy Note8 est conçu pour ceux qui agissent, ceux qui tentent, ceux qui créent. La précision de son S Pen offre des possibilités qui n’ont de limite que votre imagination. Crayonner le concept qui va changer le monde ? Vous le voulez. Prendre une note sans même allumer l’écran Infinity ? Vous le pouvez. Traduire instantanément en 71 langues différentes le pitch de votre prochaine grande idée ? Vous le devez. Le smartphone de ceux qui dessinent et créent nos lendemain. Galaxy Note8 , do bigger things.');
        $product2->setDateCreate(new \DateTime('2018-05-09 09:35:36'));
        $product2->setManufacturer($this->getReference('manufacturer1'));
        $manager->persist($product2);

        $product3 = new Product;
        $product3->setName('iPhone 8 Plus');
        $product3->setSize('158.4 x 78.1 x 7.5 mm');
        $product3->setMultimedia('Caméra principale : 12 mégapixels');
        $product3->setNetworks('Bluetooth 5.0 - Catégorie 16:1000Mbits/s - Bandes 4G FDD - Bandes 4G TDD - Wi-Fi 802.11ac');
        $product3->setScreen('5.5 pouces');
        $product3->setAutonomy('Jusqu\'à 21 heures');
        $product3->setDescription('L’iPhone 8 Plus inaugure une nouvelle génération d’iPhone.
			Paré du verre le plus résistant jamais conçu pour un smartphone et d’un contour plus solide en aluminium de qualité aérospatiale, il secharge sans fil et
			résiste à l’eau et à la poussière. Il intègre un écran Retina HD de 5,5 pouces avec affichage True Tone. Le double appareil photo 12 Mpx s’équipe d’un mode 
			Portrait amélioré et de la nouvelle fonctionnalité Éclairage de portrait. Il est piloté par A11 Bionic, la puce la plus puissante et la plus intelligente jamais
			vue sur un smartphone. Et il prend en charge les expériences de réalité augmentée dans les apps et les jeux. Avec l’iPhone 8 Plus, l’intelligence n’a jamais
			pris une forme aussi nouvelle. Ni aussi belle.');
        $product3->setDateCreate(new \DateTime('2018-05-09 09:35:36'));
        $product3->setManufacturer($this->getReference('manufacturer2'));
        $manager->persist($product3);

        /*$product4 = new Product;
        $product4->setName('');
        $product4->setSize('');
        $product4->setMultimedia('');
        $product4->setNetworks('');
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
        $product5->setNetworks('');
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
        $product6->setNetworks('');
        $product6->setScreen('');
        $product6->setAutonomy('');
        $product6->setDescription('');
        $product6->setDateCreate(new \DateTime('2018-05-09 09:35:36'));
        $product6->setManufacturer($this->getReference('manufacturer2'));
        $manager->persist($product6);*/

        $manager->flush();

        $this->addReference('product1', $product1);
        $this->addReference('product2', $product2);
        $this->addReference('product3', $product3);
        /*$this->addReference('product4', $product4);
        $this->addReference('product5', $product5);
        $this->addReference('product6', $product6);*/
    }

    public function getDependencies()
    {
        return array(
        LoadManufacturer::class,
        );
    }
}