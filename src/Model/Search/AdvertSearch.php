<?php


namespace App\Model\Search;


use App\Entity\User;

class AdvertSearch
{
    /**
     * @var ?string
     */
    private $title = '';

    /**
     * @var ?User
     */
    private $user;

    /**
     * @return User|null
     */
    public function getUser(): ?User
    {
        return $this->user;
    }

    /**
     * @param User|null $user
     * @return AdvertSearch
     */
    public function setUser(?User $user): AdvertSearch
    {
        $this->user = $user;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * @param string|null $title
     * @return AdvertSearch
     */
    public function setTitle(?string $title): AdvertSearch
    {
        $this->title = $title;
        return $this;
    }
}