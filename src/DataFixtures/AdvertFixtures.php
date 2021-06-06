<?php

namespace App\DataFixtures;

use App\Entity\Advert;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class AdvertFixtures extends Fixture implements DependentFixtureInterface
{
    public function getDependencies(): array
    {
        return [
            UserFixtures::class,
        ];
    }

    public function load(ObjectManager $manager)
    {
        $user1= $this->getReference('membre1');
        $user2= $this->getReference('membre2');

        $advert1=new Advert();
        $advert1->setTitle("Lampe vintage");
        $advert1->setPublisher($user1);
        $advert1->setContent('Vend lampe vintage des années 70');
        $advert1->setPrice(20);
        $advert1->setPublishedAt(new \DateTime('now'));
        $manager->persist($advert1);

        $advert2=new Advert();
        $advert2->setTitle("Lampe à lave");
        $advert2->setPublisher($user1);
        $advert2->setContent('Vend lampe à lave très bon état');
        $advert2->setPrice(25);
        $advert2->setPublishedAt(new \DateTime('now'));
        $manager->persist($advert2);

        $advert2=new Advert();
        $advert2->setTitle("Jouet en bois");
        $advert2->setPublisher($user1);
        $advert2->setContent('Bon état, convient aux enfants de plus de 5 ans');
        $advert2->setPrice(30);
        $advert2->setPublishedAt(new \DateTime('now'));
        $manager->persist($advert2);

        $advert3=new Advert();
        $advert3->setTitle("Kit couture");
        $advert3->setPublisher($user1);
        $advert3->setContent("Je vend ce kit couture jamais utilisé, n'hésitez pas à me contactez au 0707070707 pour plus d'informations");
        $advert3->setPrice(20);
        $advert3->setPublishedAt(new \DateTime('now'));
        $manager->persist($advert3);

        $advert4=new Advert();
        $advert4->setTitle("Tapis retro");
        $advert4->setPublisher($user1);
        $advert4->setContent('Neuf, avec étiquette');
        $advert4->setPrice(40);
        $advert4->setPublishedAt(new \DateTime('now'));
        $manager->persist($advert4);

        $advert5=new Advert();
        $advert5->setTitle("Lustre");
        $advert5->setPublisher($user1);
        $advert5->setContent('Lustre de diamètre 120 cm');
        $advert5->setPrice(100);
        $advert5->setPublishedAt(new \DateTime('now'));
        $manager->persist($advert5);

        $advert6=new Advert();
        $advert6->setTitle("Cartable");
        $advert6->setPublisher($user2);
        $advert6->setContent('Cartable en cuir');
        $advert6->setPrice(50);
        $advert6->setPublishedAt(new \DateTime('now'));
        $manager->persist($advert6);

        $advert7=new Advert();
        $advert7->setTitle("Set de verre en cristal");
        $advert7->setPublisher($user2);
        $advert7->setContent("A vendre en lot ou à l'unité");
        $advert7->setPrice(20);
        $advert7->setPublishedAt(new \DateTime('now'));
        $manager->persist($advert7);

        $advert8=new Advert();
        $advert8->setTitle("Ours en peluche");
        $advert8->setPublisher($user2);
        $advert8->setContent('Neuf avec étiquette, lavable en machine');
        $advert8->setPrice(3);
        $advert8->setPublishedAt(new \DateTime('now'));
        $manager->persist($advert8);

        $advert9=new Advert();
        $advert9->setTitle("Robe ");
        $advert9->setPublisher($user2);
        $advert9->setContent('Vend robe taille 38, convient à un S ou à un M');
        $advert9->setPrice(10);
        $advert9->setPublishedAt(new \DateTime('now'));
        $manager->persist($advert9);

        $advert10=new Advert();
        $advert10->setTitle("PS4");
        $advert10->setPublisher($user2);
        $advert10->setContent('Console avec 1 manette, prix à débattre');
        $advert10->setPrice(200);
        $advert10->setPublishedAt(new \DateTime('now'));
        $manager->persist($advert10);

        $manager->flush();
    }
}
