<?php

namespace App\Entity;

use App\Repository\EleveRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=EleveRepository::class)
 */
class Eleve
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     * @Assert\Length(min=2, max=255, minMessage="Ecrivez entre 2 et 255 caractères", maxMessage="Ecrivez entre 2 et 255 caractères" )
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     * @Assert\Length(min=2, max=255, minMessage="Ecrivez entre 2 et 255 caractères", maxMessage="Ecrivez entre 2 et 255 caractères")
     */
    private $prenom;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateNaissanceAt;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank()
     * @Assert\Length(min=1, max=2, minMessage="Ecrivez entre 1 et 2 caractères ", maxMessage="Ecrivez entre 1 et 2 caractères")
     * @Assert\Positive
     */
    private $moyenne;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     * @Assert\Length(min=2, minMessage="Ecrivez minimun 2 caractères")
     */
    private $appreciation;

    /**
     * @ORM\ManyToOne(targetEntity=ClasseDEcole::class, inversedBy="eleves")
     */
    private $classeDEcole;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getDateNaissanceAt(): ?\DateTimeInterface
    {
        return $this->dateNaissanceAt;
    }

    public function setDateNaissanceAt(\DateTimeInterface $dateNaissanceAt): self
    {
        $this->dateNaissanceAt = $dateNaissanceAt;

        return $this;
    }

    public function getMoyenne(): ?int
    {
        return $this->moyenne;
    }

    public function setMoyenne(int $moyenne): self
    {
        $this->moyenne = $moyenne;

        return $this;
    }

    public function getAppreciation(): ?string
    {
        return $this->appreciation;
    }

    public function setAppreciation(string $appreciation): self
    {
        $this->appreciation = $appreciation;

        return $this;
    }

    public function getClasseDEcole(): ?ClasseDEcole
    {
        return $this->classeDEcole;
    }

    public function setClasseDEcole(?ClasseDEcole $classeDEcole): self
    {
        $this->classeDEcole = $classeDEcole;

        return $this;
    }
}
