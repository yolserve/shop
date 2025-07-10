<?php

namespace App\Twig\Components;

use App\Catalog\Repository\CategoryRepository;
use App\Catalog\Repository\ProductRepository;
use Symfony\UX\LiveComponent\Attribute\AsLiveComponent;
use Symfony\UX\LiveComponent\Attribute\LiveProp;
use Symfony\UX\LiveComponent\DefaultActionTrait;

#[AsLiveComponent]
final class SearchProduct
{
    use DefaultActionTrait;

    #[LiveProp(writable: true, url: true)]
    public ?string $query = null;

    #[LiveProp(writable: true)]
    public ?int $limit = 10;

    #[LiveProp(writable: true)]
    public ?int $page = 1;

    #[LiveProp(writable: true)]
    public ?array $queryCategories = [];

    #[LiveProp(writable: true)]
    public ?array $queryBrands = [];

    #[LiveProp(writable: true)]
    public ?float $minPrice = null;

    #[LiveProp(writable: true)]
    public ?float $maxPrice = null;

    #[LiveProp(writable: true)]
    public ?string $sortBy = 'name';

    #[LiveProp(writable: true)]
    public ?string $sortOrder = 'ASC';

    public function __construct(private ProductRepository $productRepository, private CategoryRepository $categoryRepository, private CategoryRepository $brandRepository) {}

    public function getProducts(): array
    {
        return $this->productRepository->search($this->query, $this->limit, $this->page, $this->queryCategories, $this->queryBrands, $this->sortBy, $this->sortOrder);
    }

    public function getCategories(): array
    {
        return $this->categoryRepository->findBy(['parentCategory' => null], ['name' => 'ASC']);
    }

    public function getBrands(): array
    {
        return $this->brandRepository->findBy(['parentBrand' => null], ['name' => 'ASC']);
    }
}
