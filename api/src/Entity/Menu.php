<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use App\Filter\LikeFilter;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Gedmo\Mapping\Annotation as Gedmo;
use Ramsey\Uuid\UuidInterface;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Serializer\Annotation\MaxDepth;
use Ramsey\Uuid\Uuid;

/**
 * Menu is your way of navigation inside your application.
 *
 * @ApiResource(
 *     normalizationContext={"groups"={"read"}, "enable_max_depth"=true},
 *     denormalizationContext={"groups"={"write"}, "enable_max_depth"=true},
 * )
 * @Gedmo\Loggable
 * @ORM\Entity(repositoryClass="App\Repository\MenuRepository")
 */
class Menu
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
     * @var string The name of this menu
     * @example webshop menu
     *
     * @Assert\NotNull
     * @Assert\Length(
     *      max = 255
     * )
     * @Groups({"read","write"})
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @Groups({"read","write"})
     * @ORM\OneToMany(targetEntity="App\Entity\MenuItem", mappedBy="menu")
     * @MaxDepth(1)
     */
    private $menuItem;

    /**
     * @Groups({"read","write"})
     * @ORM\OneToOne(targetEntity="App\Entity\Header", mappedBy="menu", cascade={"persist", "remove"})
     * @MaxDepth(1)
     */
    private $header;

    /**
     * @Groups({"read","write"})
     * @ORM\OneToOne(targetEntity="App\Entity\Footer", mappedBy="menu", cascade={"persist", "remove"})
     * @MaxDepth(1)
     */
    private $footer;

    public function __construct()
    {
        $this->menuItem = new ArrayCollection();
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

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection|MenuItem[]
     */
    public function getMenuItem(): Collection
    {
        return $this->menuItem;
    }

    public function addMenuItem(MenuItem $menuItem): self
    {
        if (!$this->menuItem->contains($menuItem)) {
            $this->menuItem[] = $menuItem;
            $menuItem->setMenu($this);
        }

        return $this;
    }

    public function removeMenuItem(MenuItem $menuItem): self
    {
        if ($this->menuItem->contains($menuItem)) {
            $this->menuItem->removeElement($menuItem);
            // set the owning side to null (unless already changed)
            if ($menuItem->getMenu() === $this) {
                $menuItem->setMenu(null);
            }
        }

        return $this;
    }

    public function getHeader(): ?Header
    {
        return $this->header;
    }

    public function setHeader(?Header $header): self
    {
        $this->header = $header;

        // set (or unset) the owning side of the relation if necessary
        $newMenu = $header === null ? null : $this;
        if ($newMenu !== $header->getMenu()) {
            $header->setMenu($newMenu);
        }

        return $this;
    }

    public function getFooter(): ?Footer
    {
        return $this->footer;
    }

    public function setFooter(?Footer $footer): self
    {
        $this->footer = $footer;

        // set (or unset) the owning side of the relation if necessary
        $newMenu = $footer === null ? null : $this;
        if ($newMenu !== $footer->getMenu()) {
            $footer->setMenu($newMenu);
        }

        return $this;
    }
}
