<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ComicStripRepository")
 */
class ComicStrip
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $comicName;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Artist", inversedBy="artistComicStrips")
     */
    private $comicArtist;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $comicDescription;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="userComics")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    public function __construct()
    {
        $this->comicArtist = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getComicName(): ?string
    {
        return $this->comicName;
    }

    public function setComicName(?string $comicName): self
    {
        $this->comicName = $comicName;

        return $this;
    }

    /**
     * @return Collection|Artist[]
     */
    public function getComicArtist(): Collection
    {
        return $this->comicArtist;
    }

    public function addComicArtist(Artist $comicArtist): self
    {
        if (!$this->comicArtist->contains($comicArtist)) {
            $this->comicArtist[] = $comicArtist;
        }

        return $this;
    }

    public function removeComicArtist(Artist $comicArtist): self
    {
        if ($this->comicArtist->contains($comicArtist)) {
            $this->comicArtist->removeElement($comicArtist);
        }

        return $this;
    }

    public function getComicDescription(): ?string
    {
        return $this->comicDescription;
    }

    public function setComicDescription(?string $comicDescription): self
    {
        $this->comicDescription = $comicDescription;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }
}
