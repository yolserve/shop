<?php

namespace App\Catalog\Entity;

use Doctrine\DBAL\Types\Types;
use Symfony\Component\Uid\Uuid;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation\Slug;
use App\Catalog\Enum\CategoryStatus;
use Doctrine\Common\Collections\Collection;
use Symfony\Bridge\Doctrine\Types\UuidType;
use App\Catalog\Repository\CategoryRepository;
use Symfony\Component\HttpFoundation\File\File;
use Doctrine\Common\Collections\ArrayCollection;
use Gedmo\Mapping\Annotation\Timestampable;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

#[ORM\Entity(repositoryClass: CategoryRepository::class)]
#[Vich\Uploadable]
class Category
{
    #[ORM\Id]
    #[ORM\Column(type: UuidType::NAME, unique: true)]
    #[ORM\GeneratedValue(strategy: 'CUSTOM')]
    #[ORM\CustomIdGenerator(class: 'doctrine.uuid_generator')]
    private ?Uuid $id = null;

    #[ORM\Column(length: 50)]
    private ?string $name = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(length: 70)]
    #[Slug(fields: ['name'])]
    private ?string $slug = null;

    #[ORM\Column(length: 255)]
    private ?string $metaTitle = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $metaDescription = null;

    #[ORM\Column(enumType: CategoryStatus::class)]
    private ?CategoryStatus $status = null;

    #[ORM\ManyToOne(targetEntity: self::class, inversedBy: 'childCategories')]
    private ?self $parentCategory = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $thumbnailUrl = null;

    #[Vich\UploadableField(mapping: 'category_thumbnail', fileNameProperty: 'thumbnailUrl')]
    private ?File $thumbnailFile;

    /**
     * @var Collection<int, self>
     */
    #[ORM\OneToMany(targetEntity: self::class, mappedBy: 'parentCategory')]
    private Collection $childCategories;

    #[ORM\Column(nullable: true)]
    #[Timestampable(on: 'update')]
    private ?\DateTimeImmutable $updatedAt = null;

    #[ORM\Column]
    #[Timestampable(on: 'create')]
    private ?\DateTimeImmutable $createdAt = null;

    public function __construct()
    {
        $this->childCategories = new ArrayCollection();
    }

    public function getId(): ?Uuid
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): static
    {
        $this->slug = $slug;

        return $this;
    }

    public function getMetaTitle(): ?string
    {
        return $this->metaTitle;
    }

    public function setMetaTitle(string $metaTitle): static
    {
        $this->metaTitle = $metaTitle;

        return $this;
    }

    public function getMetaDescription(): ?string
    {
        return $this->metaDescription;
    }

    public function setMetaDescription(?string $metaDescription): static
    {
        $this->metaDescription = $metaDescription;

        return $this;
    }

    public function getStatus(): ?CategoryStatus
    {
        return $this->status;
    }

    public function setStatus(CategoryStatus $status): static
    {
        $this->status = $status;

        return $this;
    }

    public function getParentCategory(): ?self
    {
        return $this->parentCategory;
    }

    public function setParentCategory(?self $parentCategory): static
    {
        $this->parentCategory = $parentCategory;

        return $this;
    }

    /**
     * @return Collection<int, self>
     */
    public function getChildCategories(): Collection
    {
        return $this->childCategories;
    }

    public function addChildCategory(self $childCategory): static
    {
        if (!$this->childCategories->contains($childCategory)) {
            $this->childCategories->add($childCategory);
            $childCategory->setParentCategory($this);
        }

        return $this;
    }

    public function removeChildCategory(self $childCategory): static
    {
        if ($this->childCategories->removeElement($childCategory)) {
            // set the owning side to null (unless already changed)
            if ($childCategory->getParentCategory() === $this) {
                $childCategory->setParentCategory(null);
            }
        }

        return $this;
    }

    public function getThumbnailUrl(): ?string
    {
        return $this->thumbnailUrl;
    }

    public function setThumbnailUrl(?string $thumbnailUrl): void
    {
        $this->thumbnailUrl = $thumbnailUrl;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get the value of thumbnailFile
     */
    public function getThumbnailFile(): ?File
    {
        return $this->thumbnailFile;
    }

    /**
     * If manually uploading a file (i.e. not using Symfony Form) ensure an instance
     * of 'UploadedFile' is injected into this setter to trigger the update. If this
     * bundle's configuration parameter 'inject_on_load' is set to 'true' this setter
     * must be able to accept an instance of 'File' as the bundle will inject one here
     * during Doctrine hydration.
     *
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile|null $thumbnailFile
     */
    public function setThumbnailFile(?File $thumbnailFile): self
    {
        $this->thumbnailFile = $thumbnailFile;

        if (null !== $thumbnailFile) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTimeImmutable();
        }

        return $this;
    }
}
