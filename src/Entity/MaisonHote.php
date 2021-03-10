<?php

namespace App\Entity;

use App\Repository\MaisonHoteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use  Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=MaisonHoteRepository::class)
 */
class MaisonHote
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
    
     */
    private $localisation;
    /**
     * @ORM\Column(type="string", length=255)
    
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(min=10, max=250,minMessage="description too short")
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $type;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotNull
     */
    private $nombre_chambres;

    /**
     * @ORM\OneToMany(targetEntity=MaisonImages::class, mappedBy="maison", orphanRemoval=true, cascade={"persist"})
     */
    private $images;

    public function __construct()
    {
        $this->images = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLocalisation(): ?string
    {
        return $this->localisation;
    }

    public function setLocalisation(string $localisation): self
    {
        $this->localisation = $localisation;

        return $this;
    }



    public function getnom(): ?string
    {
        return $this->nom;
    }

    public function setnom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }


    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getNombreChambres(): ?int
    {
        return $this->nombre_chambres;
    }

    public function setNombreChambres(int $nombre_chambres): self
    {
        $this->nombre_chambres = $nombre_chambres;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

    /**
     * @return Collection|MaisonImages[]
     */
    public function getImages(): Collection
    {
        return $this->images;
    }

    public function addImage(MaisonImages $image): self
    {
        if (!$this->images->contains($image)) {
            $this->images[] = $image;
            $image->setMaison($this);
        }

        return $this;
    }

    public function removeImage(MaisonImages $image): self
    {
        if ($this->images->removeElement($image)) {
            // set the owning side to null (unless already changed)
            if ($image->getMaison() === $this) {
                $image->setMaison(null);
            }
        }

        return $this;
    }
}
