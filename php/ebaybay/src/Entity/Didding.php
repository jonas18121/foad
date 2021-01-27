<?php

namespace App\Entity;

use App\Repository\DiddingRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DiddingRepository::class)
 */
class Didding
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
    private $priceStart;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $priceEnd;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $priceImmediate;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $priceShopper;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateStartAt;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateEndAt;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isActive;


    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="diddings")
     */
    private $shopper;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $bestPrice;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $winner;

    /**
     * @ORM\ManyToOne(targetEntity=Product::class, inversedBy="diddings")
     * @ORM\JoinColumn(nullable=false)
     */
    private $product;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPriceStart(): ?int
    {
        return $this->priceStart;
    }

    public function setPriceStart(int $priceStart): self
    {
        $this->priceStart = $priceStart;

        return $this;
    }

    public function getPriceEnd(): ?int
    {
        return $this->priceEnd;
    }

    public function setPriceEnd(?int $priceEnd): self
    {
        $this->priceEnd = $priceEnd;

        return $this;
    }

    public function getPriceImmediate(): ?int
    {
        return $this->priceImmediate;
    }

    public function setPriceImmediate(?int $priceImmediate): self
    {
        $this->priceImmediate = $priceImmediate;

        return $this;
    }

    public function getPriceShopper(): ?int
    {
        return $this->priceShopper;
    }

    public function setPriceShopper(?int $priceShopper): self
    {
        $this->priceShopper = $priceShopper;

        return $this;
    }

    public function getDateStartAt(): ?\DateTimeInterface
    {
        return $this->dateStartAt;
    }

    public function setDateStartAt(\DateTimeInterface $dateStartAt): self
    {
        $this->dateStartAt = $dateStartAt;

        return $this;
    }

    public function getDateEndAt(): ?\DateTimeInterface
    {
        return $this->dateEndAt;
    }

    public function setDateEndAt(\DateTimeInterface $dateEndAt): self
    {
        $this->dateEndAt = $dateEndAt;

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

    public function getIsActive(): ?bool
    {
        return $this->isActive;
    }

    public function setIsActive(bool $isActive): self
    {
        $this->isActive = $isActive;

        return $this;
    }

    public function getShopper(): ?User
    {
        return $this->shopper;
    }

    public function setShopper(?User $shopper): self
    {
        $this->shopper = $shopper;

        return $this;
    }

    public function getBestPrice(): ?int
    {
        return $this->bestPrice;
    }

    public function setBestPrice(?int $bestPrice): self
    {
        $this->bestPrice = $bestPrice;

        return $this;
    }

    public function getWinner(): ?bool
    {
        return $this->winner;
    }

    public function setWinner(?bool $winner): self
    {
        $this->winner = $winner;

        return $this;
    }

    public function getProduct(): ?Product
    {
        return $this->product;
    }

    public function setProduct(?Product $product): self
    {
        $this->product = $product;

        return $this;
    }
}
