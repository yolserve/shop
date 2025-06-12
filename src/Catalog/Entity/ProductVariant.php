<?php

namespace App\Catalog\Entity;

use App\Catalog\Enum\VariantStatus;
use App\Repository\ProductVariantRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Types\UuidType;
use Symfony\Component\Uid\Uuid;

#[ORM\Entity(repositoryClass: ProductVariantRepository::class)]
class ProductVariant
{
    #[ORM\Id]
    #[ORM\Column(type: UuidType::NAME, unique: true)]
    #[ORM\GeneratedValue(strategy: 'CUSTOM')]
    #[ORM\CustomIdGenerator(class: 'doctrine.uuid_generator')]
    private ?Uuid $id = null;

    #[ORM\Column]
    private ?float $price = null;

    #[ORM\Column(length: 20)]
    private ?string $sku = null;

    #[ORM\Column(enumType: VariantStatus::class)]
    private ?VariantStatus $variantStatus = null;

    /**
     * @var Collection<int, VariantAttribute>
     */
    #[ORM\OneToMany(targetEntity: VariantAttribute::class, mappedBy: 'productVariant')]
    private Collection $variantAttributes;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?Inventory $inventory = null;

    public function __construct()
    {
        $this->variantAttributes = new ArrayCollection();
    }

    public function getId(): ?Uuid
    {
        return $this->id;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): static
    {
        $this->price = $price;

        return $this;
    }

    public function getSku(): ?string
    {
        return $this->sku;
    }

    public function setSku(string $sku): static
    {
        $this->sku = $sku;

        return $this;
    }

    public function getVariantStatus(): ?VariantStatus
    {
        return $this->variantStatus;
    }

    public function setVariantStatus(VariantStatus $variantStatus): static
    {
        $this->variantStatus = $variantStatus;

        return $this;
    }

    /**
     * @return Collection<int, VariantAttribute>
     */
    public function getVariantAttributes(): Collection
    {
        return $this->variantAttributes;
    }

    public function addVariantAttribute(VariantAttribute $variantAttribute): static
    {
        if (!$this->variantAttributes->contains($variantAttribute)) {
            $this->variantAttributes->add($variantAttribute);
            $variantAttribute->setProductVariant($this);
        }

        return $this;
    }

    public function removeVariantAttribute(VariantAttribute $variantAttribute): static
    {
        if ($this->variantAttributes->removeElement($variantAttribute)) {
            // set the owning side to null (unless already changed)
            if ($variantAttribute->getProductVariant() === $this) {
                $variantAttribute->setProductVariant(null);
            }
        }

        return $this;
    }

    public function getInventory(): ?Inventory
    {
        return $this->inventory;
    }

    public function setInventory(?Inventory $inventory): static
    {
        $this->inventory = $inventory;

        return $this;
    }
}
