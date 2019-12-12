<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\ImageRepository")
 */
class Image
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Link", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $name;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Link", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $alt;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Link", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $href;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?Link
    {
        return $this->name;
    }

    public function setName(Link $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getAlt(): ?Link
    {
        return $this->alt;
    }

    public function setAlt(Link $alt): self
    {
        $this->alt = $alt;

        return $this;
    }

    public function getHref(): ?Link
    {
        return $this->href;
    }

    public function setHref(Link $href): self
    {
        $this->href = $href;

        return $this;
    }
}
