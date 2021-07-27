<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Product;
use App\Entity\SubCategory;
use App\Repository\CategoryRepository;
use App\Repository\ProductRepository;
use App\Repository\SubCategoryRepository;
use FOS\RestBundle\View\View;
use Nelmio\ApiDocBundle\Annotation\Model;
use Swagger\Annotations as SWG;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractController
{
    /**
     * List all the categories.
     *
     * @Route("/api/categories", methods={"GET"})
     * @SWG\Parameter(name="perPageRecords", in="query", required=false, type="integer", default=25, maximum=500,description="current page per records value" )
     * @SWG\Parameter(name="page", in="query", required=false, type="integer", default=1, minimum=1, description="current page number")
     *
     * @SWG\Response(
     *     response=200,
     *     description="Returns the categories of an user",
     *     @SWG\Schema(
     *         type="array",
     *         @SWG\Items(ref=@Model(type=Category::class, groups={"full"})),
     *         @SWG\Items(type="integer", title="total_records"),
     *         @SWG\Items(type="integer", title="total_pages")
     *     )
     * )
     * @SWG\Tag(name="category")
     */
    public function getAllCategories(CategoryRepository $categoryRepository): View
    {
        return $this->createView([
            'categories' => $categoryRepository->getAll(),
            'total_records' => $categoryRepository->getTotalRecords(),
            'total_pages' => $categoryRepository->getTotalPages(),
        ], Response::HTTP_OK);
    }

    /**
     * List all the sub categories.
     *
     * @Route("/api/category/{id}/subcategories", methods={"GET"})
     *
     * @SWG\Response(
     *     response=200,
     *     description="Returns the sub_categories of a category",
     *     @SWG\Schema(
     *         type="array",
     *         @SWG\Items(ref=@Model(type=SubCategory::class, groups={"full"})),
     *     )
     * )
     * @SWG\Tag(name="category")
     */
    public function getSubCategories(Category $category, SubCategoryRepository $subCategoryRepository): View
    {
        return $this->createView([
            'sub_categories' => $subCategoryRepository->getFormattedResult($category->getSubCategories())
        ], Response::HTTP_OK);
    }

    /**
     * List all the categories.
     *
     * @Route("/api/category/{id}/products", methods={"GET"})
     *
     * @SWG\Response(
     *     response=200,
     *     description="Returns the sub_categories of a category",
     *     @SWG\Schema(
     *         type="array",
     *         @SWG\Items(ref=@Model(type=Product::class, groups={"full"})),
     *     )
     * )
     * @SWG\Tag(name="category")
     */
    public function getProducts(Category $category, ProductRepository $productRepository): View
    {
        return $this->createView([
            'products' => $productRepository->getFormattedResult($category->getProducts())
        ], Response::HTTP_OK);
    }
}
