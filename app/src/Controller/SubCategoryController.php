<?php

namespace App\Controller;

use App\Entity\Product;
use App\Entity\SubCategory;
use App\Repository\ProductRepository;
use FOS\RestBundle\View\View;
use Nelmio\ApiDocBundle\Annotation\Model;
use Swagger\Annotations as SWG;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SubCategoryController extends AbstractController
{
    /**
     * List all the sub categories.
     *
     * @Route("/api/subcategory/{id}/products", methods={"GET"})
     *
     * @SWG\Response(
     *     response=200,
     *     description="Returns the products of a sub_category",
     *     @SWG\Schema(
     *         type="array",
     *         @SWG\Items(ref=@Model(type=Product::class, groups={"full"})),
     *     )
     * )
     * @SWG\Tag(name="sub_category")
     */
    public function getSubCategories(SubCategory $subCategory, ProductRepository $productRepository): View
    {
        return $this->createView([
            'products' => $productRepository->getFormattedResult($subCategory->getProducts())
        ], Response::HTTP_OK);
    }
}
