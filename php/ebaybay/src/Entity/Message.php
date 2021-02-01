<?php

namespace App\Entity;

use App\Repository\MessageRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MessageRepository::class)
 */
class Message
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     */
    private $content;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\ManyToOne(targetEntity=user::class, inversedBy="messages")
     */
    private $userReceived;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="messageSend")
     */
    private $userSend;


    public function __construct()
    {
        $this->userSend = new ArrayCollection();
    }

    

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

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

    public function getUserReceived(): ?user
    {
        return $this->userReceived;
    }

    public function setUserReceived(?user $userReceived): self
    {
        $this->userReceived = $userReceived;

        return $this;
    }

    public function getUserSend(): ?User
    {
        return $this->userSend;
    }

    public function setUserSend(?User $userSend): self
    {
        $this->userSend = $userSend;

        return $this;
    }


}
