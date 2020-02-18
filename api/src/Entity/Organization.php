<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Serializer\Annotation\MaxDepth;
use Symfony\Component\Validator\Constraints as Assert;


use App\Entity\Style;
use App\Entity\Application;
use App\Entity\Image;
/**
 * An organization as active on commonground.
 *
 * @ApiResource(
 *     normalizationContext={"groups"={"read"}, "enable_max_depth"=true},
 *     denormalizationContext={"groups"={"write"}, "enable_max_depth"=true},
 * )
 * @Gedmo\Loggable
 * 
 * @ORM\Entity(repositoryClass="App\Repository\OrganizationRepository")
 */
class Organization
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
	 * @var string The rsin of this organisations.
	 *
	 * @example About
	 *
	 * @Assert\NotNull
	 * @Assert\Length(
	 *     max = 255
	 * )
	 * @Groups({"read","write"})
	 * @ORM\Column(type="string", length=255)
	 */
	private $rsin;	
	
	/**
	 * @var string The name of this organization.
	 *
	 * @example About
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
	 * @var string The description of this organisation.
	 *
	 * @example This is the manucipality of Utrecht
	 *
	 * @Assert\NotNull
	 * @Assert\Length(
	 *     max = 255
	 * )
	 * @Groups({"read","write"})
	 * @ORM\Column(type="string", length=255)
	 */
	private $description;

    /**
     * @Groups({"read","write"})
     * @MaxDepth(1)
     * @ORM\ManyToOne(targetEntity="App\Entity\Image")
     */
    private $logo;

    /**
     * @Groups({"read","write"})
     * @MaxDepth(1)
     * @ORM\OneToMany(targetEntity="App\Entity\Style", mappedBy="organization", orphanRemoval=true)
     */
    private $styles;

    /**
     * @MaxDepth(1)
     * @ORM\OneToMany(targetEntity="App\Entity\Application", mappedBy="organization", orphanRemoval=true)
     */
    private $applications;

    /**
     * @MaxDepth(1)
     * @ORM\OneToMany(targetEntity="App\Entity\Image", mappedBy="organization", orphanRemoval=true)
     */
    private $images;
    
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
    	$this->styles= new ArrayCollection();
    	$this->applications = new ArrayCollection();
        $this->images = new ArrayCollection();
    }

    public function getId(): ?Uuid
    {
        return $this->id;
    }
    
    public function setId(Uuid $id): self
    {
    	$this->id = $id;
    	
    	return $this;
    }
    
    public function getRsin(): ?string
    {
    	return $this->rsin;
    }
    
    public function setRsin(string $rsin): self
    {
    	$this->rsin = $rsin;
    	
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

    public function getLogo(): ?Image
    {
        return $this->logo;
    }

    public function setLogo(?Image $logo): self
    {
        $this->logo = $logo;

        return $this;
    }

    public function getStyles(): ?Collection
    {
        return $this->styles;
    }
    
    public function addStyle(Style $style): self
    {
    	if (!$this->styles->contains($style)) {
    		$this->styles[] = $style;
    		$style->setOrganization($this);
    	}
    	
    	return $this;
    }
    
    public function removeStyle(Style $style): self
    {
    	if ($this->styles->contains($style)) {
    		$this->styles->removeElement($style);
    		// set the owning side to null (unless already changed)
    		if ($style->getOrganization() === $this) {
    			$style->setOrganization(null);
    		}
    	}
    	
    	return $this;
    }

    public function getApplications(): ?Collection
    {
        return $this->applications;
    }
    
    public function addApplication(Application $application): self
    {
    	if (!$this->applications->contains($application)) {
    		$this->applications[] = $application;
    		$image->setOrganization($this);
    	}
    	
    	return $this;
    }
    
    public function removeApplication(Application $application): self
    {
    	if ($this->applications->contains($application)) {
    		$this->applications->removeElement($application);
    		// set the owning side to null (unless already changed)
    		if ($application->getOrganization() === $this) {
    			$application->setOrganization(null);
    		}
    	}
    	
    	return $this;
    }


    /**
     * @return Collection|Image[]
     */
    public function getImages(): Collection
    {
        return $this->images;
    }

    public function addImage(Image $image): self
    {
        if (!$this->images->contains($image)) {
            $this->images[] = $image;
            $image->setOrganization($this);
        }

        return $this;
    }

    public function removeImage(Image $image): self
    {
        if ($this->images->contains($image)) {
            $this->images->removeElement($image);
            // set the owning side to null (unless already changed)
            if ($image->getOrganization() === $this) {
                $image->setOrganization(null);
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
