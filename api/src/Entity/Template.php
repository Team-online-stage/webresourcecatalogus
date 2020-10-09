<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\BooleanFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\DateFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\OrderFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use App\Controller\DefaultController;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Gedmo\Translatable\Translatable;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Serializer\Annotation\MaxDepth;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Templates holds information your pages or include in messages.
 *
 * @ApiResource(
 *      attributes={"pagination_items_per_page"=30},
 *     	normalizationContext={"groups"={"read"}, "enable_max_depth"=true},
 *     	denormalizationContext={"groups"={"write"}, "enable_max_depth"=true},
 *     itemOperations={
 * 		"get",
 * 	    "put",
 * 	   "delete",
 *     "render_template"={
 *         "method"="POST",
 *         "path"="/templates/{id}/render",
 *         "controller"=DefaultController::class,
 *         "formats"={"json", "jsonld", "jsonhal", "xml", "pdf"={"application/pdf"}, "word"={"application/vnd.ms-word", "application/vnd.openxmlformats-officedocument.wordprocessing"}}
 *     		},
 *     "get_change_logs"={
 *              "path"="/templates/{id}/change_log",
 *              "method"="get",
 *              "swagger_context" = {
 *                  "summary"="Changelogs",
 *                  "description"="Gets al the change logs for this resource"
 *              }
 *          },
 *     "get_audit_trail"={
 *              "path"="/templates/{id}/audit_trail",
 *              "method"="get",
 *              "swagger_context" = {
 *                  "summary"="Audittrail",
 *                  "description"="Gets the audit trail for this resource"
 *              }
 *          }
 * 		}
 * )
 * @ORM\Entity(repositoryClass="App\Repository\TemplateRepository")
 * @Gedmo\Loggable(logEntryClass="Conduction\CommonGroundBundle\Entity\ChangeLog")
 *
 * @ApiFilter(BooleanFilter::class)
 * @ApiFilter(OrderFilter::class)
 * @ApiFilter(DateFilter::class, strategy=DateFilter::EXCLUDE_NULL)
 * @ApiFilter(SearchFilter::class, properties={
 *     "application.id": "exact",
 *     "organization.id": "exact",
 *     "slugs.id": "exact",
 *     "templateEngine": "exact",
 *     "slugs.slug": "exact",
 *     "title": "ipartial",
 *     "name": "partial",
 *     "description": "ipartial",
 *     "content": "partial",
 *     "templateGroups.name": "partial",
 *     "templateGroups.id": "exact"})
 */
class Template implements Translatable
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
     * @var string The internal name of this menu
     *
     * @example webshop menu
     *
     * @Gedmo\Translatable
     * @Gedmo\Versioned
     * @Assert\NotNull
     * @Assert\Length(
     *      max = 255
     * )
     * @Groups({"read","write"})
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @var string The external name of this menu
     *
     * @example webshop menu
     *
     * @Gedmo\Translatable
     * @Gedmo\Versioned
     * @Assert\Length(
     *      max = 255
     * )
     * @Groups({"read","write"})
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $title;

    /**
     * @var string The description of this page.
     *
     * @example This page holds info about this application
     *
     * @Gedmo\Translatable
     * @Gedmo\Versioned
     * @Assert\NotNull
     * @Assert\Length(
     *     max = 255
     * )
     * @Groups({"read","write"})
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * @var bool Whether to auto create a slug on creation of this template
     *
     * @example true
     *
     * @Groups({"write"})
     */
    private $createSlug;

    /**
     * @var string The Content of this template.
     *
     * @example A lot of random info over any topic
     *
     * @Gedmo\Translatable
     * @Gedmo\Versioned
     * @Assert\NotNull
     * @Groups({"read","write"})
     * @ORM\Column(type="text")
     */
    private $content;

    /**
     * @var array Optional variables ussed during rendering
     *
     * @Groups({"read","write"})
     */
    private $variables = [];

    /**
     * @var string The template engine used to render this template. Schould be either twig (Twig), md (Markdown) or rst (reStructuredText)
     *
     * @example twig
     *
     * @Gedmo\Versioned
     * @Assert\NotNull
     * @Assert\Choice({"twig", "md", "rst"})
     * @Groups({"read","write"})
     * @ORM\Column(type="string", length=16)
     */
    private $templateEngine;

    /**
     * @Groups({"read","write"})
     * @ORM\OneToMany(targetEntity="App\Entity\Slug", mappedBy="template", cascade={"persist"})
     * @MaxDepth(1)
     */
    private $slugs;

    /**
     * @MaxDepth(1)
     * @ORM\ManyToOne(targetEntity="App\Entity\Application", inversedBy="templates")
     * @ORM\JoinColumn(nullable=false, nullable=true)
     */
    private $application;

    /**
     * @Groups({"read","write"})
     * @MaxDepth(1)
     * @ORM\ManyToOne(targetEntity="App\Entity\Organization", inversedBy="templates")
     * @ORM\JoinColumn(nullable=false, nullable=true)
     */
    private $organization;

    /**
     * @Groups({"read","write"})
     * @MaxDepth(1)
     * @ORM\ManyToMany(targetEntity="App\Entity\TemplateGroup", inversedBy="templates")
     */
    private $templateGroups;

    /**
     * @Groups({"read"})
     * @Gedmo\Locale
     * Used locale to override Translation listener`s locale
     * this is not a mapped field of entity metadata, just a simple property
     * and it is not necessary because globally locale can be set in listener
     */
    private $locale;

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

    public function __construct()
    {
        $this->image = new ArrayCollection();
        $this->slugs = new ArrayCollection();
        $this->templateGroups = new ArrayCollection();
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

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getCreateSlug(): ?string
    {
        return $this->createSlug;
    }

    public function setCreateSlug(bool $createSlug): self
    {
        $this->createSlug = $createSlug;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getVariables(): ?array
    {
        return $this->variables;
    }

    public function setVariables(array $variables): self
    {
        $this->variables = $variables;

        return $this;
    }

    public function getTemplateEngine(): ?string
    {
        return $this->templateEngine;
    }

    public function setTemplateEngine(string $templateEngine): self
    {
        $this->templateEngine = $templateEngine;

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
            $slug->setTemplate($this);
        }

        return $this;
    }

    public function removeSlug(Slug $slug): self
    {
        if ($this->slugs->contains($slug)) {
            $this->slugs->removeElement($slug);
            // set the owning side to null (unless already changed)
            if ($slug->getTemplate() === $this) {
                $slug->setTemplate(null);
            }
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
     * @return Collection|TemplateGroup[]
     */
    public function getTemplateGroups(): Collection
    {
        return $this->templateGroups;
    }

    public function addTemplateGroup(TemplateGroup $templateGroup): self
    {
        if (!$this->templateGroups->contains($templateGroup)) {
            $this->templateGroups[] = $templateGroup;
        }

        return $this;
    }

    public function removeTemplateGroup(TemplateGroup $templateGroup): self
    {
        if ($this->templateGroups->contains($templateGroup)) {
            $this->templateGroups->removeElement($templateGroup);
        }

        return $this;
    }

    public function setTranslatableLocale($locale)
    {
        $this->locale = $locale;
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
}
