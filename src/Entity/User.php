<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @UniqueEntity(fields={"username"}, message="There is already an account with this username")
 */
class User implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $username;

    /**
     * @ORM\Column(type="string", length=1024)
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $roles = ['ROLE_USER'];

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ComicStrip", mappedBy="user")
     */
    private $userComics;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Gallery", mappedBy="user", orphanRemoval=true)
     */
    private $gallery;

    public function __construct()
    {
        $this->userComics = new ArrayCollection();
        $this->gallery = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getRoles()
    {
        if (empty($this->roles)) {
            $this->roles = ['ROLE_USER'];
        }
        return $this->roles;
    }

    public function setRoles(?array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getSalt()
    {
        // TODO: Implement getSalt() method.
    }

    /**
     * @inheritDoc
     */
    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
    }

    /**
     * @return Collection|ComicStrip[]
     */
    public function getUserComics(): Collection
    {
        return $this->userComics;
    }

    public function addUserComic(ComicStrip $userComic): self
    {
        if (!$this->userComics->contains($userComic)) {
            $this->userComics[] = $userComic;
            $userComic->setUser($this);
        }

        return $this;
    }

    public function removeUserComic(ComicStrip $userComic): self
    {
        if ($this->userComics->contains($userComic)) {
            $this->userComics->removeElement($userComic);
            // set the owning side to null (unless already changed)
            if ($userComic->getUser() === $this) {
                $userComic->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Gallery[]
     */
    public function getGallery(): Collection
    {
        return $this->gallery;
    }

    public function addGallery(Gallery $gallery): self
    {
        if (!$this->gallery->contains($gallery)) {
            $this->gallery[] = $gallery;
            $gallery->setUser($this);
        }

        return $this;
    }

    public function removeGallery(Gallery $gallery): self
    {
        if ($this->gallery->contains($gallery)) {
            $this->gallery->removeElement($gallery);
            // set the owning side to null (unless already changed)
            if ($gallery->getUser() === $this) {
                $gallery->setUser(null);
            }
        }

        return $this;
    }
}
