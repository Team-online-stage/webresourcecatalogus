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

/**
 * A page holds your content in your application.
 *
 * @ApiResource(
 *     normalizationContext={"groups"={"read"}, "enable_max_depth"=true},
 *     denormalizationContext={"groups"={"write"}, "enable_max_depth"=true},
 * )
 * @Gedmo\Loggable
 * @ORM\Entity(repositoryClass="App\Repository\PageRepository")
 */
class Page
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
	 * @Groups({"read","write"})
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $description;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Content")
     */
    private $content;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $templateEngine;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Application", inversedBy="pages")
     * @ORM\JoinColumn(nullable=false)
     */
    private $application;

    public function __construct()
    {
        $this->content = new ArrayCollection();
    }

    public function getId(): ?string
    {
        return $this->id;
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

    public function getTemplateEngine(): ?string
    {
        return $this->templateEngine;
    }

    public function setTemplateEngine(string $templateEngine): self
    {
        $this->templateEngine = $templateEngine;

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

    /**
     * @return Collection|Content[]
     */
    public function getContent(): Collection
    {
        return $this->content;
    }

    public function addContent(Content $content): self
    {
        if (!$this->content->contains($content)) {
            $this->content[] = $content;
        }

        return $this;
    }

    public function removeContent(Content $content): self
    {
        if ($this->content->contains($content)) {
            $this->content->removeElement($content);
        }

        return $this;
    }
}
