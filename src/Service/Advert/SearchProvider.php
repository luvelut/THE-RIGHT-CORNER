<?php


namespace App\Service\Advert;



use App\Entity\User;
use App\Model\Search\AdvertSearch;
use App\Repository\AdvertRepository;
use Symfony\Component\Security\Core\Security;

class SearchProvider
{
    private Security $security;
    private AdvertRepository $advertRepository;

    public function __construct(Security $security, AdvertRepository $advertRepository)
    {
        $this->security=$security;
        $this->advertRepository=$advertRepository;
    }

    public function getLastAdvert(AdvertSearch $search) :array
    {
         return array_slice(($this->advertRepository->searchAdvert($search)),0,10);
    }

    public function getAdverts() :array
    {
        return $this->advertRepository->searchAllAdvert();
    }

    public function getUserAdverts() :array
    {
        $user=$this->security->getUser();
        if (!($user instanceof User)) {
            return []; //or throw new exception
        }
        return $this->advertRepository->searchUserAdvert($user);
    }


}