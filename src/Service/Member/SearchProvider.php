<?php


namespace App\Service\Member;


use App\Repository\UserRepository;


class SearchProvider
{

    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository=$userRepository;
    }

    public function getMembers() :array
    {
        return $this->userRepository->searchMembers();
    }
}