<?php

namespace App\Entity;

use App\Repository\UserRepository;
use App\Security\Role;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @ORM\Table(name="`user`")
 * @method string getUserIdentifier()
 */
class User implements UserInterface, \Serializable
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     * @Assert\Length(max=50,min=0,maxMessage="Votre login doit avoir entre 1 et 50 caractères.")
     * @Assert\NotBlank(message="Vous devez mettre un login.")
     */
    private $login;

    /**
     * @ORM\Column(type="string", length=50)
     * @Assert\Length(max=50,min=0,maxMessage="Votre nom doit avoir entre 1 et 50 caractères.")
     * @Assert\NotBlank(message="Vous devez mettre un nom.")
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $password;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isAdmin;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\OneToMany(targetEntity=Advert::class, mappedBy="publisher")
     */
    private $adverts;

    /**
     * @Assert\Regex(
     *     pattern = "/^[a-zA-Z0-9]{8,}$/",
     *     match=true,
     *     message="Le mot de passe doit comporter au moins huit caractères, dont des lettres majuscules et minuscules et un chiffre."
     * )
     * @Assert\NotBlank(message="Vous devez mettre un mot de passe.")
     */
    private $plainPassword;

    /**
     * @return mixed
     */
    public function getPlainPassword()
    {
        return $this->plainPassword;
    }

    /**
     * @param mixed $plainPassword
     * @return User
     */
    public function setPlainPassword($plainPassword)
    {
        $this->plainPassword = $plainPassword;
        return $this;
    }


    public function __construct()
    {
        $this->adverts = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLogin(): ?string
    {
        return $this->login;
    }

    public function setLogin(string $login): self
    {
        $this->login = $login;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getIsAdmin(): ?bool
    {
        return $this->isAdmin;
    }

    public function setIsAdmin(bool $isAdmin): self
    {
        $this->isAdmin = $isAdmin;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * @return Collection|Advert[]
     */
    public function getAdverts(): Collection
    {
        return $this->adverts;
    }

    public function addAdvert(Advert $advert): self
    {
        if (!$this->adverts->contains($advert)) {
            $this->adverts[] = $advert;
            $advert->setPublisher($this);
        }

        return $this;
    }

    public function removeAdvert(Advert $advert): self
    {
        if ($this->adverts->removeElement($advert)) {
            // set the owning side to null (unless already changed)
            if ($advert->getPublisher() === $this) {
                $advert->setPublisher(null);
            }
        }

        return $this;
    }

    public function serialize()
    {
        return serialize([
            $this->id,
            $this->login,
            $this->password
        ]);
    }

    public function unserialize($serialized)
    {
        list(
            $this->id,
            $this->login,
            $this->password
            ) = unserialize($serialized, ['allowed_classes'=>false]);
    }

    public function getRoles()
    {
        if ($this->isAdmin) {
            return [Role::ROLE_ADMIN];
        }
        return [Role::ROLE_MEMBER];
    }

    public function getSalt()
    {
        return null;
    }

    public function eraseCredentials()
    {

    }

    public function getUsername()
    {
        return $this->getLogin();
    }

    public function __call($name, $arguments)
    {
        return $this->getLogin();
    }
}
