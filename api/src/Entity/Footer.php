<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use App\Filter\LikeFilter;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Gedmo\Mapping\Annotation as Gedmo;
use Ramsey\Uuid\UuidInterface;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Serializer\Annotation\MaxDepth;
use Ramsey\Uuid\Uuid;

/**
 * Footer can hold a logo and menu or other links.
 *
 * @ApiResource(
 *     normalizationContext={"groups"={"read"}, "enable_max_depth"=true},
 *     denormalizationContext={"groups"={"write"}, "enable_max_depth"=true},
 * )
 * @Gedmo\Loggable
 * @ORM\Entity(repositoryClass="App\Repository\FooterRepository")
 */
class Footer
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
     * @Groups({"read","write"})
     * @ORM\OneToOne(targetEntity="App\Entity\Image", cascade={"persist", "remove"})
     * @MaxDepth(1)
     */
    private $logo;

    /**
     * @Groups({"read","write"})
     * @ORM\OneToOne(targetEntity="App\Entity\Menu", inversedBy="footer", cascade={"persist", "remove"})
     * @MaxDepth(1)
     */
    private $menu;

    /**
     * @Groups({"read","write"})
     * @ORM\ManyToMany(targetEntity="App\Entity\Image", inversedBy="footers")
     * @MaxDepth(1)
     */
    private $image;

    /**
     * @Groups({"read","write"})
     * @ORM\OneToOne(targetEntity="App\Entity\Application", mappedBy="footer", cascade={"persist", "remove"})
     * @MaxDepth(1)
     */
    private $application;

    public function __construct()
    {
        $this->image = new ArrayCollection();
    }
    
    public function getId(): Uuid
    {
    	return $this->id;
    }
    
    public function setId(Uuid $id): self
    {
    	$this->id = $id;
    	
    	return $this;
    }

    public function getLogo(): ?Image
    {
        return $this->logo;
    }

    public function setLogo(?Image $logo): self
    {
        $this->logo = $logo;

        return $this;
    }

    public function getMenu(): ?Menu
    {
        return $this->menu;
    }

    public function setMenu(?Menu $menu): self
    {
        $this->menu = $menu;

        return $this;
    }

    /**
     * @return Collection|Image[]
     */
    public function getImage(): Collection
    {
        return $this->image;
    }

    public function addImage(Image $image): self
    {
        if (!$this->image->contains($image)) {
            $this->image[] = $image;
        }

        return $this;
    }

    public function removeImage(Image $image): self
    {
        if ($this->image->contains($image)) {
            $this->image->removeElement($image);
        }

        return $this;
    }

    public function getApplication(): ?Application
    {
        return $this->application;
    }

    public function setApplication(?Application $application): self
    {
        $this->application = $application;

        // set (or unset) the owning side of the relation if necessary
        $newFooter = $application === null ? null : $this;
        if ($newFooter !== $application->getFooter()) {
            $application->setFooter($newFooter);
        }

        return $this;
    }


}
