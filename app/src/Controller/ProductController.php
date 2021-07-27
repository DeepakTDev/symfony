<?php

namespace App\Controller;

use App\DataObjects\Product;
use App\Form\Type\ProductType;
use App\Repository\ProductRepository;
use FOS\RestBundle\View\View;
use Swagger\Annotations as SWG;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    /**
     * List all the sub categories.
     *
     * @Route("/api/product", methods={"POST"})
     * @SWG\Parameter(name="product",type="json", in="body",
     *     @SWG\Schema(
     *          @SWG\Property(property="name", type="string",description="Name of the product"),
     *          @SWG\Property(property="category_id", type="integer",description="uniqueId of category field"),
     *          @SWG\Property(property="sub_category_id", type="integer",description="uniqueId of category field"),
     *     )
     * )
     *
     * @SWG\Response(
     *     response=204,
     *     description="product save successfully"
     * )
     * @SWG\Tag(name="product")
     */
    public function saveProduct(Request $request, ProductRepository $productRepository): View
    {
        $form = $this->createForm(ProductType::class, new Product($this->getDoctrine()));
        $form->submit($request->request->all());

        if (!$form->isValid()) {
            throw new HttpException(Response::HTTP_BAD_REQUEST, 'Invalid form data');
        }

        $productRepository->saveProduct($form->getData());

        return $this->createView();
    }
}
