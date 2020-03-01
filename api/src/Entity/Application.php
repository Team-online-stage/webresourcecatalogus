<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\DateFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Serializer\Annotation\MaxDepth;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Application is the project of a website.
 *
 * @ApiResource(
 *     normalizationContext={"groups"={"read"}, "enable_max_depth"=true},
 *     denormalizationContext={"groups"={"write"}, "enable_max_depth"=true},
 *     collectionOperations={
 *     		"get",
 *     		"post",
 *     		"get_page_on_slug"={
 *     			"method"="GET",
 *     			"path"="/applications/{id}/{slug}",
 *     			"swagger_context" = {
 *     				"summary"="Get an page trough its slug",
 *     				"description"="Get an page trough its slug"
 *     			}
 *     		}
 *     }
 * )
 * @ApiFilter(SearchFilter::class, properties={"id": "exact", "name": "exact", "description": "partial", "domain": "exact"})
 * @ApiFilter(DateFilter::class, properties={"dateCreated","dateModified"})
 * @Gedmo\Loggable
 * @ORM\Entity(repositoryClass="App\Repository\ApplicationRepository")
 */
class Application
{
    /**
     * @var UuidInterface The UUID identifier of this resource
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
     * @var string The name of this application.
     *
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
     *
     * @example Is the best site ever
     *
     * @Assert\NotNull
     * @Assert\Length(
     *      max = 255
     * )
     * @Gedmo\Versioned
     * @Groups({"read","write"})
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @var string The domain of this application.
     *
     * @example https://www.example.org
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
     * @ORM\OneToMany(targetEntity="App\Entity\Page", mappedBy="application")
     * @MaxDepth(1)
     */
    private $pages;

    /**
     * @Groups({"read","write"})
     * @ORM\OneToOne(targetEntity="App\Entity\Header", inversedBy="application", cascade={"persist", "remove"})
     * @MaxDepth(1)
     */
    private $header;

    /**
     * @Groups({"read","write"})
     * @ORM\OneToOne(targetEntity="App\Entity\Footer", inversedBy="application", cascade={"persist", "remove"})
     * @MaxDepth(1)
     */
    private $footer;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Slug", mappedBy="application")
     * @MaxDepth(1)
     */
    private $slugs;
    
    /**
     * @Groups({"read","write"})
     * @MaxDepth(1)
     * @ORM\ManyToOne(targetEntity="App\Entity\Organization", inversedBy="applications")
     * @ORM\JoinColumn(nullable=false)
     */
    private $organization;
    
    /**
     * @Groups({"read","write"})
     * @MaxDepth(1)
     * @ORM\OneToMany(targetEntity="App\Entity\Configuration", mappedBy="application", orphanRemoval=true)
     */
    private $configurations;
    
    /**
     * @MaxDepth(1)
     * @ORM\OneToMany(targetEntity="App\Entity\Template", mappedBy="application", orphanRemoval=true)
     */
    private $templates;
    
    /**
     * @MaxDepth(1)
     * @ORM\OneToMany(targetEntity="App\Entity\Menu", mappedBy="application", orphanRemoval=true)
     */
    private $menus;
    
    /**
     * @var Datetime $dateCreated The moment this request was created
     *
     * @Groups({"read"})
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $dateCreated;
    
    /**
     * @var Datetime $dateModified  The moment this request last Modified
     *
     * @Groups({"read"})
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $dateModified;

    public function __construct()
    {
        $this->pages = new ArrayCollection();
        $this->slugs = new ArrayCollection();
        $this->configurations = new ArrayCollection();
        $this->templates = new ArrayCollection();
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

    public function setHeader(?Header $header): self
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

    /**
     * @return Collection|Slug[]
     */
    public function getSlugs(): Collection
    {
        return $this->slugs;
    }

    public function addSlug(Slug $slug): self
    {
        if (!$this->slugs->contains($slug)) {
            $this->slugs[] = $slug;
            $slug->setApplication($this);
        }

        return $this;
    }

    public function removeSlug(Slug $slug): self
    {
        if ($this->slugs->contains($slug)) {
            $this->slugs->removeElement($slug);
            // set the owning side to null (unless already changed)
            if ($slug->getApplication() === $this) {
                $slug->setApplication(null);
            }
        }

        return $this;
    }
    
    public function getOrganization(): ?Organization
    {
    	return $this->organization;
    }
    
    public function setOrganization(?Organization $organization): self
    {
    	$this->organization = $organization;
    	
    	return $this;
    }
    
    /**
     * @return Collection|Configuration[]
     */
    public function getConfigurations(): Collection
    {
    	return $this->configurations;
    }
    
    public function addConfiguration(Configuration $configuration): self
    {
    	if (!$this->configurations->contains($configuration)) {
    		$this->configurations[] = $configuration;
    		$configuration->setApplication($this);
    	}
    	
    	return $this;
    }
    
    public function removeConfiguration(Configuration $configuration): self
    {
    	if ($this->configurations->contains($configuration)) {
    		$this->configurations->removeElement($configuration);
    		// set the owning side to null (unless already changed)
    		if ($configuration->getApplication() === $this) {
    			$configuration->setApplication(null);
    		}
    	}
    	
    	return $this;
    }
    
    /**
     * @return Collection|Templates[]
     */
    public function getTemplates(): Collection
    {
    	return $this->templates;
    }
    
    public function addTemplate(Template $template): self
    {
    	if (!$this->templates->contains($configuration)) {
    		$this->templates[] = $configuration;
    		$template->setApplication($this);
    	}
    	
    	return $this;
    }
    
    public function removeTemplate(Template $template): self
    {
    	if ($this->templates->contains($template)) {
    		$this->templates->removeElement($template);
    		// set the owning side to null (unless already changed)
    		if ($template->getApplication() === $this) {
    			$template->setApplication(null);
    		}
    	}
    	
    	return $this;
    }
    
    /**
     * @return Collection|Menus[]
     */
    public function getMenus(): Collection
    {
    	return $this->menus;
    }
    
    public function addMenu(Menu $template): self
    {
    	if (!$this->menus->contains($menu)) {
    		$this->menus[] = $menu;
    		$menu->setApplication($this);
    	}
    	
    	return $this;
    }
    
    public function removeMenu(Menu $menu): self
    {
    	if ($this->menus->contains($menu)) {
    		$this->menus->removeElement($menu);
    		// set the owning side to null (unless already changed)
    		if ($menu->getApplication() === $this) {
    			$menu->setApplication(null);
    		}
    	}
    	
    	return $this;
    }
    
    public function getDateCreated(): ?\DateTimeInterface
    {
    	return $this->dateCreated;
    }
    
    public function setDateCreated(\DateTimeInterface $dateCreated): self
    {
    	$this->dateCreated= $dateCreated;
    	
    	return $this;
    }
    
    public function getDateModified(): ?\DateTimeInterface
    {
    	return $this->dateModified;
    }
    
    public function setDateModified(\DateTimeInterface $dateModified): self
    {
    	$this->dateModified = $dateModified;
    	
    	return $this;
    }
}
