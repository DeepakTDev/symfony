<?php

namespace App\Repository;

use App\Entity\Category;
use App\Service\Pagination;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Category|null find($id, $lockMode = null, $lockVersion = null)
 * @method Category|null findOneBy(array $criteria, array $orderBy = null)
 * @method Category[]    findAll()
 * @method Category[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CategoryRepository extends ServiceEntityRepository
{   
    private Pagination $pagination;
    public function __construct(ManagerRegistry $registry, Pagination $pagination)
    {
        parent::__construct($registry, Category::class);
        $this->pagination = $pagination;
    }


    public function getAll()
    {
        return $this->findBy([], null, $this->pagination->getPerPageRecords(), $this->pagination->getOffsetRecords());
    }

    public function getTotalRecords(): int
    {
        $this->pagination->setTotalRecords($this->count([]));

        return $this->pagination->getTotalRecords();
    }

    public function getTotalPages(): int
    {
        return $this->pagination->getTotalPages();
    }
}
