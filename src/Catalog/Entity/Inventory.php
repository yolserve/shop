<?php

namespace App\Catalog\Entity;

use App\Catalog\Repository\InventoryRepository;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation\Timestampable;
use Symfony\Bridge\Doctrine\Types\UuidType;
use Symfony\Component\Uid\Uuid;

#[ORM\Entity(repositoryClass: InventoryRepository::class)]
class Inventory
{
    #[ORM\Id]
    #[ORM\Column(type: UuidType::NAME, unique: true)]
    #[ORM\GeneratedValue(strategy: 'CUSTOM')]
    #[ORM\CustomIdGenerator(class: 'doctrine.uuid_generator')]
    private ?Uuid $id = null;

    #[ORM\Column]
    private ?int $quantityAvailable = 0;

    #[ORM\Column]
    private ?int $quantityReserved = 0;

    #[ORM\Column]
    private ?int $lowStockThreshold = 0;

    #[ORM\Column]
    #[Timestampable(on: 'update')]
    private ?\DateTime $lastUpdated = null;

    public function getId(): ?Uuid
    {
        return $this->id;
    }

    public function getQuantityAvailable(): ?int
    {
        return $this->quantityAvailable;
    }

    public function setQuantityAvailable(?int $quantityAvailable): static
    {
        $this->quantityAvailable = $quantityAvailable;

        return $this;
    }

    public function getQuantityReserved(): ?int
    {
        return $this->quantityReserved;
    }

    public function setQuantityReserved(?int $quantityReserved): static
    {
        $this->quantityReserved = $quantityReserved;

        return $this;
    }

    public function getLowStockThreshold(): ?int
    {
        return $this->lowStockThreshold;
    }

    public function setLowStockThreshold(?int $lowStockThreshold): static
    {
        $this->lowStockThreshold = $lowStockThreshold;

        return $this;
    }

    public function getLastUpdated(): ?\DateTime
    {
        return $this->lastUpdated;
    }

    public function setLastUpdated(\DateTime $lastUpdated): static
    {
        $this->lastUpdated = $lastUpdated;

        return $this;
    }
}
