<?php

namespace App\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use App\Entity\Client;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class ClientCommand extends ContainerAwareCommand
{
    private $manager;

    public function __construct(UserPasswordEncoderInterface $encoder, ObjectManager $manager, string $name = null)
    {
        parent::__construct($name);
        $this->encoder = $encoder;
        $this->manager = $manager;
    }

    protected function configure()
    {
        $this
            ->setName('demo:load')
            ->setDescription('Add Client for user test')
            ->addArgument('client')
        ;
    }

    public function load()
    {
        $clientTest = new Client();
        $clientTest->setEmail('admin@example.com');

        $plainPassword = 'admin';
        $encoded = $this->encoder->encodePassword($clientTest, $plainPassword);
        $clientTest->setPassword($encoded);

        $this->manager->persist($clientTest);
        $this->manager->flush();
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $client = $input->getArgument('client');
        $text = strtoupper('Bad Command');

        if (true == $client) {
            $this->load();
            $text = strtoupper('Client OK');
        }

        $output->writeln($text);
    }
}
