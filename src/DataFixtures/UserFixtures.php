<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{

    /**
     * @var UserPasswordEncoderInterface
     */
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        $user1=new User();
        $user1->setLogin("admin");
        $user1->setName("admin");
        $user1->setPassword($this->encoder->encodePassword($user1, 'admin'));
        $user1->setIsAdmin(true);
        $user1->setCreatedAt(new \DateTime('now'));
        $manager->persist($user1);

        $user2=new User();
        $user2->setLogin("membre1");
        $user2->setName("membre1");
        $user2->setPassword($this->encoder->encodePassword($user2, 'membre1'));
        $user2->setIsAdmin(false);
        $user2->setCreatedAt(new \DateTime('now'));
        $manager->persist($user2);

        $user3=new User();
        $user3->setLogin("membre2");
        $user3->setName("membre2");
        $user3->setPassword($this->encoder->encodePassword($user3, 'membre2'));
        $user3->setIsAdmin(false);
        $user3->setCreatedAt(new \DateTime('now'));
        $manager->persist($user3);

        $manager->flush();

        $this->addReference('membre1', $user2);
        $this->addReference('membre2', $user3);
    }

}
