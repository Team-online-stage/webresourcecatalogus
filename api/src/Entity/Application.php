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
 * Application is your base of a website.
 *
 * @ApiResource(
 *     normalizationContext={"groups"={"read"}, "enable_max_depth"=true},
 *     denormalizationContext={"groups"={"write"}, "enable_max_depth"=true},
 * )
 * @Gedmo\Loggable
 * @ORM\Entity(repositoryClass="App\Repository\ApplicationRepository")
 */
class Application
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
	 * @var string The name of this application.
	 * @example Webshop
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
	 * @var string The description of this application.
	 * @example Is the best site ever
     *
	 * @Assert\NotNull
	 * @Assert\Length(
	 *      max = 2555
	 * )
	 * @Gedmo\Versioned
	 * @Groups({"read","write"})
	 * @ORM\Column(type="text", nullable=true)
	 */
	private $description;

    /**
     * @var string The domain of this application.
     * @example https://www.webshop.nl
     *
     * @Assert\NotNull
     * @Assert\Length(
     *      max = 255
     * )
     * @Groups({"read","write"})
     * @ORM\Column(type="string", length=255)
     */
    private $domain;

    /**
     * @Groups({"read","write"})
     * @ORM\OneToMany(targetEntity="App\Entity\Page", mappedBy="application")
     * @MaxDepth(1)
     */
    private $pages;

    /**
     * @Groups({"read","write"})
     * @ORM\OneToOne(targetEntity="App\Entity\Header", cascade={"persist", "remove"})
     * @MaxDepth(1)
     */
    private $header;

    /**
     * @Groups({"read","write"})
     * @ORM\OneToOne(targetEntity="App\Entity\Footer", cascade={"persist", "remove"})
     * @MaxDepth(1)
     */
    private $footer;

    public function __construct()
    {
        $this->pages = new ArrayCollection();
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

    public function getDescription(): ?string
    {
    	return $this->description;
    }

    public function setDescription(?string $description): self
    {
    	$this->description = $description;

    	return $this;
    }

    public function getDomain(): ?string
    {
        return $this->domain;
    }

    public function setDomain(string $domain): self
    {
        $this->domain = $domain;

        return $this;
    }

    /**
     * @return Collection|Page[]
     */
    public function getPages(): Collection
    {
        return $this->pages;
    }

    public function addPage(Page $page): self
    {
        if (!$this->pages->contains($page)) {
            $this->pages[] = $page;
            $page->setApplication($this);
        }

        return $this;
    }

    public function removePage(Page $page): self
    {
        if ($this->pages->contains($page)) {
            $this->pages->removeElement($page);
            // set the owning side to null (unless already changed)
            if ($page->getApplication() === $this) {
                $page->setApplication(null);
            }
        }

        return $this;
    }

    public function getHeader(): ?Header
    {
        return $this->header;
    }

    public function setHeader(Header $header): self
    {
        $this->header = $header;

        return $this;
    }

    public function getFooter(): ?Footer
    {
        return $this->footer;
    }

    public function setFooter(?Footer $footer): self
    {
        $this->footer = $footer;

        return $this;
    }
}
