<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use App\Filter\LikeFilter;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Ramsey\Uuid\UuidInterface;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Serializer\Annotation\MaxDepth;

/**
 * Image speaks for itself.
 *
 * @ApiResource(
 *     normalizationContext={"groups"={"read"}, "enable_max_depth"=true},
 *     denormalizationContext={"groups"={"write"}, "enable_max_depth"=true},
 * )
 * @Gedmo\Loggable
 * @ORM\Entity(repositoryClass="App\Repository\ImageRepository")
 */
class Image
{
	/**
	 * @var UuidInterface The UUID identifier of this resource
	 * @example e2984465-190a-4562-829e-a8cca81aa35d
	 *
	 * @Assert\Uuid
	 * @Groups({"read"})
	 * @ORM\Id
	 * @ORM\Column(type="uuid", unique=true)
	 * @ORM\GeneratedValue(strategy="CUSTOM")
	 * @ORM\CustomIdGenerator(class="Ramsey\Uuid\Doctrine\UuidGenerator")
	 */
	private $id;

    /**
     * @var string The name of this image
     * @example Flowers
     *
     * @Assert\NotNull
     * @Assert\Length(
     *     max = 255
     * )
	 * @Groups({"read","write"})
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @var string The alt of of this image for people with poor eyesight
     * @example flowers
     *
     * @Assert\NotNull
     * @Assert\Length(
     *     max = 255
     * )
     * @Groups({"read","write"})
     * @ORM\Column(type="string", length=255)
     */
    private $alt;

    /**
     * @var string The href of this image
     * @example app_img_flowers
     *
     * @Assert\NotNull
     * @Assert\Length(
     *     max = 255
     * )
     * @Groups({"read","write"})
     * @ORM\Column(type="string", length=255)
     */
    private $href;

    /**
     * @Groups({"read","write"})
     * @ORM\OneToOne(targetEntity="App\Entity\Header", mappedBy="logo", cascade={"persist", "remove"})
     * @MaxDepth(1)
     */
    private $logo;

    /**
     * @Groups({"read","write"})
     * @ORM\ManyToMany(targetEntity="App\Entity\Header", mappedBy="image")
     * @MaxDepth(1)
     */
    private $headers;

    public function __construct()
    {
        $this->headers = new ArrayCollection();
    }

    public function getId(): ?string
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

    public function getAlt(): ?string
    {
        return $this->alt;
    }

    public function setAlt(string $alt): self
    {
        $this->alt = $alt;

        return $this;
    }

    public function getHref(): ?string
    {
        return $this->href;
    }

    public function setHref(string $href): self
    {
        $this->href = $href;

        return $this;
    }

    public function getLogo(): ?Header
    {
        return $this->logo;
    }

    public function setLogo(?Header $logo): self
    {
        $this->logo = $logo;

        // set (or unset) the owning side of the relation if necessary
        $newLogo = $logo === null ? null : $this;
        if ($newLogo !== $logo->getLogo()) {
            $logo->setLogo($newLogo);
        }

        return $this;
    }

    /**
     * @return Collection|Header[]
     */
    public function getHeaders(): Collection
    {
        return $this->headers;
    }

    public function addHeader(Header $header): self
    {
        if (!$this->headers->contains($header)) {
            $this->headers[] = $header;
            $header->addImage($this);
        }

        return $this;
    }

    public function removeHeader(Header $header): self
    {
        if ($this->headers->contains($header)) {
            $this->headers->removeElement($header);
            $header->removeImage($this);
        }

        return $this;
    }
}
