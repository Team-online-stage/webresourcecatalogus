<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use App\Filter\LikeFilter;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Ramsey\Uuid\UuidInterface;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Serializer\Annotation\MaxDepth;

/**
 * MenuItem is a part of a menu and can be a link or submenu.
 *
 * @ApiResource(
 *     normalizationContext={"groups"={"read"}, "enable_max_depth"=true},
 *     denormalizationContext={"groups"={"write"}, "enable_max_depth"=true},
 * )
 * @Gedmo\Loggable
 * @ORM\Entity(repositoryClass="App\Repository\MenuItemRepository")
 */
class MenuItem
{
	/**
	 * @var UuidInterface
	 *
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
	 * @var string The name of this example property
	 *
	 * @example My Group
	 *
	 * @Assert\NotNull
	 * @Assert\Length(
	 *      max = 255
	 * )
	 * @Gedmo\Versioned
	 * @Groups({"read","write"})
	 * @ORM\Column(type="string", length=255)
	 */
	private $name;

	/**
	 * @var string The description of this example property
	 *
	 * @example Is the best group ever
	 *
	 * @Assert\Length(
	 *      max = 2555
	 * )
	 * @Gedmo\Versioned
	 * @Groups({"read","write"})
	 * @ORM\Column(type="text", nullable=true)
	 */
	private $description;

    /**
     * @var string An url
	 *
	 * @example http
	 *
	 * @Assert\Length(
	 *      max = 2555
	 * )
	 * @Gedmo\Versioned
	 * @Groups({"read","write"})
     * @ORM\Column(type="string", length=255)
     */
    private $href;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Menu", inversedBy="menuItem")
     * @ORM\JoinColumn(nullable=false)
     * MaxDepth(1)
     */
    private $menu;

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

    public function getDescription(): ?string
    {
    	return $this->description;
    }

    public function setDescription(?string $description): self
    {
    	$this->description = $description;

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

    public function getMenu(): ?Menu
    {
        return $this->menu;
    }

    public function setMenu(?Menu $menu): self
    {
        $this->menu = $menu;

        return $this;
    }
}
