<?php

namespace App\Repository;

use App\Entity\Product;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Product|null find($id, $lockMode = null, $lockVersion = null)
 * @method Product|null findOneBy(array $criteria, array $orderBy = null)
 * @method Product[]    findAll()
 * @method Product[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductRepository extends ServiceEntityRepository
{

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Product::class);
    }

    public function getFormattedResult(Collection $products): array
    {
        $formattedResult  = [];

        foreach ($products as $product) {
            $formattedResult[] = [
                'id' => $product->getId(),
                'name' => $product->getName(),
                'created_at' => $product->getCreatedAt()
            ];
        }

        return $formattedResult;
    }

    public function saveProduct(\App\DataObjects\Product $productDTO) {
        $product = new Product(
            $productDTO->getName(),
            new \Datetime(),
            new \DateTime(),
            $productDTO->getCategory(),
            $productDTO->getSubCategory()
        );

        $this->getEntityManager()->persist($product);
        $this->getEntityManager()->flush($product);
    }
}
