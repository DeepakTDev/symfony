<?php

namespace App\Request\ParamConverter;

use App\Repository\CategoryRepository;
use Doctrine\Persistence\ManagerRegistry;
use App\Service\Pagination;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Request\ParamConverter\ParamConverterInterface;
use Symfony\Component\HttpFoundation\Request;

class CategoryParamConverter implements ParamConverterInterface
{
    private ManagerRegistry $registry;

    private Pagination $paginationService;

    const CONVERTER_NAME = 'fetch_categories';

    public function __construct(ManagerRegistry $registry, Pagination $paginationService)
    {
        $this->registry = $registry;
        $this->paginationService = $paginationService;
    }

    public function apply(Request $request, ParamConverter $configuration)
    {
        if (!empty($perPageRecords = $request->query->get('perPageRecords'))
            && !empty($page = $request->query->get('page'))) {
            $this->paginationService->setCurrentPage($page);
            $this->paginationService->setPerPageRecords($perPageRecords);
        }

        $categoryRepository = new CategoryRepository(
            $this->registry,
            $this->paginationService
        );

        $request->attributes->set('categoryRepository', $categoryRepository);
    }

    public function supports(ParamConverter $configuration): bool
    {
        return self::CONVERTER_NAME === $configuration->getConverter();
    }
}
