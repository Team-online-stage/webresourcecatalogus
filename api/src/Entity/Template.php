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
 * Content holds information and photos you want to show on your pages.
 *
 * @ApiResource(
 *     normalizationContext={"groups"={"read"}, "enable_max_depth"=true},
 *     denormalizationContext={"groups"={"write"}, "enable_max_depth"=true},
 * )
 * @Gedmo\Loggable
 * @ORM\Entity(repositoryClass="App\Repository\TemplateRepository")
 */
class Template
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
     * @var string The Content of this template.
     * @example A lot of random info over any topic
     *
     * @Assert\NotNull
     * @Assert\Length(
     *      max = 2555
     * )
	 * @Groups({"read","write"})
     * @ORM\Column(type="string", length=2555)
     */
    private $content;

    /**
     * @Groups({"read","write"})
     * @ORM\ManyToMany(targetEntity="App\Entity\Image")
     * @MaxDepth(1)
     */
    private $image;       
    
    /**
     * @var string The template engine used to render this template. Schould be either twig (Twig), md (markdown) or rst (reStructuredText)
     * @example Twig
     *
     * @Assert\NotNull
     * @Assert\Choice({"twig", "md", "rst"})
     * @Groups({"read","write"})
     * @ORM\Column(type="string", length=16)
     */
    private $templateEngine;

    
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

    public function getContent(): ?string
    {
        return $this->data;
    }

    public function setContent(string $content): self
    {
    	$this->content = $content;

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
    
    
    
    public function getTemplateEngine(): ?string
    {
    	return $this->templateEngine;
    }
    
    public function setTemplateEngine(string $templateEngine): self
    {
    	$this->templateEngine = $templateEngine;
    	
    	return $this;
    }
}
