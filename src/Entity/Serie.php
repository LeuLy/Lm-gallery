<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SerieRepository")
 */
class Serie
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
    private $serName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $serEditor;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSerName(): ?string
    {
        return $this->serName;
    }

    public function setSerName(string $serName): self
    {
        $this->serName = $serName;

        return $this;
    }

    public function getSerEditor(): ?string
    {
        return $this->serEditor;
    }

    public function setSerEditor(string $serEditor): self
    {
        $this->serEditor = $serEditor;

        return $this;
    }
}
