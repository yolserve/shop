<?php

namespace App\Catalog\Entity;

use App\Catalog\Repository\VariantAttributeRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VariantAttributeRepository::class)]
class VariantAttribute
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 20)]
    private ?string $label = null;

    #[ORM\Column(length: 20)]
    private ?string $value = null;

    #[ORM\ManyToOne(inversedBy: 'variantAttributes')]
    private ?ProductVariant $productVariant = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function setLabel(string $label): static
    {
        $this->label = $label;

        return $this;
    }

    public function getProductVariant(): ?ProductVariant
    {
        return $this->productVariant;
    }

    public function setProductVariant(?ProductVariant $productVariant): static
    {
        $this->productVariant = $productVariant;

        return $this;
    }

    /**
     * Get the value of value
     */
    public function getValue(): ?string
    {
        return $this->value;
    }

    /**
     * Set the value of value
     */
    public function setValue(?string $value): self
    {
        $this->value = $value;

        return $this;
    }
}
