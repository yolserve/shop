<?php

namespace App\Catalog\Repository;


use App\Catalog\Entity\Product;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @extends ServiceEntityRepository<Product>
 */
class ProductRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Product::class);
    }

    public function search(
        ?string $searchQuery = null,
        ?int $limit = 10,
        int $page = 1,
        ?array $categories = [],
        ?array $brands = [],
        // ?float $minPrice = null,
        // ?float $maxPrice = null,
        ?string $sortBy = 'name',
        ?string $sortOrder = 'ASC'
    ): array {
        $query = $this->createQueryBuilder('p');

        if (!empty($searchQuery)) {
            $query->andWhere('p.name LIKE :query OR p.description LIKE :query')
                ->setParameter('query', '%' . $searchQuery . '%');
        }

        if (!empty($categories)) {
            $query->andWhere('p.category IN (:categories)')
                ->setParameter('categories', $categories);
        }

        if (!empty($brands)) {
            $query->andWhere('p.brand IN (:brands)')
                ->setParameter('brands', $brands);
        }


        // if ($minPrice !== null) {
        //     $query->andWhere('p.price >= :minPrice')
        //         ->setParameter('minPrice', $minPrice);
        // }
        // if ($maxPrice !== null) {
        //     $query->andWhere('p.price <= :maxPrice')
        //         ->setParameter('maxPrice', $maxPrice);
        // }

        $allowedSortFields = ['name', 'price', 'createdAt', 'rating'];
        $allowedSortOrder = ['ASC', 'DESC'];
        if (!in_array($sortBy, $allowedSortFields)) {
            $sortBy = 'name';
        }
        if (!in_array(strtoupper($sortOrder), $allowedSortOrder)) {
            $sortOrder = 'ASC';
        }
        $query->orderBy("p.$sortBy", $sortOrder);

        $offset = ($page - 1) * $limit;
        $query->setFirstResult($offset)->setMaxResults($limit);

        return $query->getQuery()->getResult();
    }


    //    /**
    //     * @return Product[] Returns an array of Product objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('p')
    //            ->andWhere('p.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('p.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Product
    //    {
    //        return $this->createQueryBuilder('p')
    //            ->andWhere('p.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
