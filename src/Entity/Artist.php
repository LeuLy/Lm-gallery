<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ArtistRepository")
 */
class Artist
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
    private $artName;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\ComicStrip", mappedBy="comicArtist")
     */
    private $artistComicStrips;

    public function __construct()
    {
        $this->artistComicStrips = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getArtName(): ?string
    {
        return $this->artName;
    }

    public function setArtName(string $artName): self
    {
        $this->artName = $artName;

        return $this;
    }

    /**
     * @return Collection|ComicStrip[]
     */
    public function getArtistComicStrips(): Collection
    {
        return $this->artistComicStrips;
    }

    public function addArtistComicStrip(ComicStrip $artistComicStrip): self
    {
        if (!$this->artistComicStrips->contains($artistComicStrip)) {
            $this->artistComicStrips[] = $artistComicStrip;
            $artistComicStrip->addComicArtist($this);
        }

        return $this;
    }

    public function removeArtistComicStrip(ComicStrip $artistComicStrip): self
    {
        if ($this->artistComicStrips->contains($artistComicStrip)) {
            $this->artistComicStrips->removeElement($artistComicStrip);
            $artistComicStrip->removeComicArtist($this);
        }

        return $this;
    }
}
