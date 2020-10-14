<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\BooleanFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\DateFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\OrderFilter;
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
 * An organization as active on commonground.
 *
 * @ApiResource(
 *     attributes={"pagination_items_per_page"=30},
 *     normalizationContext={"groups"={"read"}, "enable_max_depth"=true},
 *     denormalizationContext={"groups"={"write"}, "enable_max_depth"=true},
 *     itemOperations={
 *          "get",
 *          "put",
 *          "delete",
 *          "get_change_logs"={
 *              "path"="/adresses/{id}/change_log",
 *              "method"="get",
 *              "swagger_context" = {
 *                  "summary"="Changelogs",
 *                  "description"="Gets al the change logs for this resource"
 *              }
 *          },
 *          "get_audit_trail"={
 *              "path"="/adresses/{id}/audit_trail",
 *              "method"="get",
 *              "swagger_context" = {
 *                  "summary"="Audittrail",
 *                  "description"="Gets the audit trail for this resource"
 *              }
 *          }
 *     }
 * )
 * @ORM\Entity(repositoryClass="App\Repository\OrganizationRepository")
 * @Gedmo\Loggable(logEntryClass="Conduction\CommonGroundBundle\Entity\ChangeLog")
 *
 * @ApiFilter(BooleanFilter::class)
 * @ApiFilter(OrderFilter::class)
 * @ApiFilter(DateFilter::class, strategy=DateFilter::EXCLUDE_NULL)
 * @ApiFilter(SearchFilter::class)
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
     * @Gedmo\Versioned
     * @Assert\NotNull
     * @Assert\Length(
     *     max = 255
     * )
     * @Groups({"read","write"})
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $rsin;

    /**
     * @var string The Chamber of Comerce ID of this organisations.
     *
     * @example About
     *
     * @Gedmo\Versioned
     * @Assert\NotNull
     * @Assert\Length(
     *     max = 255
     * )
     * @Groups({"read","write"})
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $chamberOfComerce;

    /**
     * @var string The name of this organization.
     *
     * @example About
     *
     * @Gedmo\Versioned
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
     * @Gedmo\Versioned
     * @Assert\Length(
     *     max = 255
     * )
     * @Groups({"read","write"})
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Image")
     */
    private $logo;

    /**
     * @Groups({"read", "write"})
     * @MaxDepth(1)
     * @ORM\ManyToOne(targetEntity="App\Entity\Style", inversedBy="organizations", cascade={"persist"})
     * @ORM\JoinColumn(nullable=true)
     */
    private $style;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Application", mappedBy="organization")
     */
    private $applications;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Image", mappedBy="organization", orphanRemoval=true)
     */
    private $images;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Configuration", mappedBy="organization")
     */
    private $configurations;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Template", mappedBy="organization", orphanRemoval=true)
     */
    private $templates;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\TemplateGroup", mappedBy="organization", orphanRemoval=true)
     */
    private $templateGroups;

    /**
     * @var Datetime The moment this request was created
     *
     * @Groups({"read"})
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $dateCreated;

    /**
     * @var Datetime The moment this request last Modified
     *
     * @Groups({"read"})
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $dateModified;

    /**
     * @var string The contact information for this organization
     *
     * @Groups({"read", "write"})
     * @Assert\Url
     * @Assert\Length(
     *     max=255
     * )
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $contact;

    /**
     * @Groups({"read", "write"})
     * @ORM\ManyToOne(targetEntity=Organization::class, inversedBy="childOrganizations")
     */
    private $parentOrganization;

    /**
     * @Groups({"read"})
     * @ORM\OneToMany(targetEntity=Organization::class, mappedBy="parentOrganization")
     */
    private $childOrganizations;

    public function __construct()
    {
        $this->applications = new ArrayCollection();
        $this->images = new ArrayCollection();
        $this->configurations = new ArrayCollection();
        $this->templates = new ArrayCollection();
        $this->childOrganizations = new ArrayCollection();
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

    public function getChamberOfComerce(): ?string
    {
        return $this->chamberOfComerce;
    }

    public function setChamberOfComerce(string $chamberOfComerce): self
    {
        $this->chamberOfComerce = $chamberOfComerce;

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

    public function getStyle(): ?Style
    {
        return $this->style;
    }

    public function setStyle(?Style $style): self
    {
        $this->style = $style;

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
            $configuration->setOrganization($this);
        }

        return $this;
    }

    public function removeConfiguration(Configuration $configuration): self
    {
        if ($this->configurations->contains($configuration)) {
            $this->configurations->removeElement($configuration);
            // set the owning side to null (unless already changed)
            if ($configuration->getOrganization() === $this) {
                $configuration->setOrganization(null);
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

    public function addTemplates(Template $template): self
    {
        if (!$this->templates->contains($template)) {
            $this->templates[] = $template;
            $template->setOrganization($this);
        }

        return $this;
    }

    public function removeTemplate(Template $template): self
    {
        if ($this->templates->contains($template)) {
            $this->templates->removeElement($template);
            // set the owning side to null (unless already changed)
            if ($template->getOrganization() === $this) {
                $template->setOrganization(null);
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
        $this->dateCreated = $dateCreated;

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

    public function getContact(): ?string
    {
        return $this->contact;
    }

    public function setContact(?string $contact): self
    {
        $this->contact = $contact;

        return $this;
    }

    public function getParentOrganization(): ?self
    {
        return $this->parentOrganization;
    }

    public function setParentOrganization(?self $parentOrganization): self
    {
        $this->parentOrganization = $parentOrganization;

        return $this;
    }

    /**
     * @return Collection|self[]
     */
    public function getChildOrganizations(): Collection
    {
        return $this->childOrganizations;
    }

    public function addChildOrganization(self $childOrganization): self
    {
        if (!$this->childOrganizations->contains($childOrganization)) {
            $this->childOrganizations[] = $childOrganization;
            $childOrganization->setParentOrganization($this);
        }

        return $this;
    }

    public function removeChildOrganization(self $childOrganization): self
    {
        if ($this->childOrganizations->contains($childOrganization)) {
            $this->childOrganizations->removeElement($childOrganization);
            // set the owning side to null (unless already changed)
            if ($childOrganization->getParentOrganization() === $this) {
                $childOrganization->setParentOrganization(null);
            }
        }

        return $this;
    }
}
