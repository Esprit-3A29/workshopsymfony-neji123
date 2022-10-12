<?php

namespace App\Entity;

use App\Repository\OkRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=OkRepository::class)
 */
class Ok
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
    private $Am;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAm(): ?string
    {
        return $this->Am;
    }

    public function setAm(string $Am): self
    {
        $this->Am = $Am;

        return $this;
    }
}
