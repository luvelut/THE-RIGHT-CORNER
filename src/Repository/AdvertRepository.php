<?php

namespace App\Repository;

use App\Entity\Advert;
use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Advert|null find($id, $lockMode = null, $lockVersion = null)
 * @method Advert|null findOneBy(array $criteria, array $orderBy = null)
 * @method Advert[]    findAll()
 * @method Advert[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AdvertRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Advert::class);
    }

    public function searchAllAdvert(){
        $query = $this
            ->createQueryBuilder('a')
            ->orderBy('a.publishedAt','DESC')
        ;


        return $query->getQuery()->getResult();
    }

    public function searchAdvert($search){
        $query = $this
            ->createQueryBuilder('a')
            ->orderBy('a.publishedAt','DESC')
        ;

        if (!empty($search->getTitle())) {
            $query=$query
                ->andWhere('a.title LIKE :q')
                ->setParameter('q', "%{$search->getTitle()}%");
        }


        return $query->getQuery()->getResult();
    }

    public function searchUserAdvert(User $user){
        $query = $this
            ->createQueryBuilder('a')
            ->orderBy('a.publishedAt','DESC')
            ->andWhere('a.publisher = :u')
            ->setParameter('u',$user)
        ;



        return $query->getQuery()->getResult();
    }
}
