<?php

namespace App\Entity;

use App\Repository\ClasseDEcoleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=ClasseDEcoleRepository::class)
 */
class ClasseDEcole
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;


    /**
     * @ORM\Column(type="integer")
     */
    private $moyenneClasse;

    /**
     * @ORM\OneToMany(targetEntity=Eleve::class, mappedBy="classeDEcole")
     */
    private $eleves;

    /**
     * @ORM\Column(type="integer")
     */
    private $numeroClasse;

    /**
     * @ORM\Column(type="integer")
     */
    private $nbEleves;

    public function __construct()
    {
        $this->eleves = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }


    public function getMoyenneClasse(): ?int
    {
        return $this->moyenneClasse;
    }

    public function setMoyenneClasse(int $moyenneClasse): self
    {
        $this->moyenneClasse = $moyenneClasse;

        return $this;
    }

    /**
     * @return Collection|Eleve[]
     */
    public function getEleves(): Collection
    {
        return $this->eleves;
    }

    public function addElefe(Eleve $elefe): self
    {
        if (!$this->eleves->contains($elefe)) {
            $this->eleves[] = $elefe;
            $elefe->setClasseDEcole($this);
        }

        return $this;
    }

    public function removeElefe(Eleve $elefe): self
    {
        if ($this->eleves->removeElement($elefe)) {
            // set the owning side to null (unless already changed)
            if ($elefe->getClasseDEcole() === $this) {
                $elefe->setClasseDEcole(null);
            }
        }

        return $this;
    }

    public function getNumeroClasse(): ?int
    {
        return $this->numeroClasse;
    }

    public function setNumeroClasse(int $numeroClasse): self
    {
        $this->numeroClasse = $numeroClasse;

        return $this;
    }

    public function getNbEleves(): ?int
    {
        return $this->nbEleves;
    }

    public function setNbEleves(int $nbEleves): self
    {
        $this->nbEleves = $nbEleves;

        return $this;
    }
}
