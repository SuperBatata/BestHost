<?php

namespace App\Entity;

use App\Repository\MaisonImagesRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MaisonImagesRepository::class)
 */
class MaisonImages
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity=MaisonHote::class, inversedBy="images")
     * @ORM\JoinColumn(nullable=false)
     */
    private $maison;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getMaison(): ?MaisonHote
    {
        return $this->maison;
    }

    public function setMaison(?MaisonHote $maison): self
    {
        $this->maison = $maison;

        return $this;
    }
}
