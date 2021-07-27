<?php

namespace App\DataObjects;

use App\Entity\Category;
use App\Entity\SubCategory;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Serializer\Annotation\SerializedName;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

class Product
{
    /**
     * @Assert\NotBlank(message="name should not be empty")
     * @Assert\Length(
     *      min = 2,
     *      max = 50,
     *      minMessage = "Product name should be greater than {{ limit }} characters long",
     *      maxMessage = "Product name should be less than {{ limit }} characters long",
     * )
     *
     * @SerializedName("name")
     */
    protected string $name;

    /**
     * @Assert\Positive
     * @Assert\NotBlank(message="category can't be empty")
     *
     * @SerializedName("category_id")
     */
    protected ?int $categoryId = null;

    /**
     * @Assert\Positive
     * @Assert\NotBlank(message="sub-category can't be empty")
     *
     * @SerializedName("subcategory_id")
     */
    protected ?int $subcategoryId = null;

    protected ManagerRegistry $manager;
    protected ?Category $category = null;
    protected ?SubCategory $subcategory = null;

    public function __construct(ManagerRegistry $manager)
    {
        $this->manager = $manager;
    }

    public function getName(): ?string
    {
        return $this->name ?? null;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getCategoryId(): ?int
    {
        return $this->categoryId;
    }

    public function setCategoryId(?int $categoryId): void
    {
        $this->categoryId = $categoryId;
    }

    public function getSubCategoryId(): ?int
    {
        return $this->subcategoryId;
    }

    public function setSubCategoryId(?int $subcategoryId): void
    {
        $this->subcategoryId = $subcategoryId;
    }

    public function getCategory(): Category
    {
        return $this->category;
    }

    public function getSubCategory(): SubCategory
    {
        return $this->subcategory;
    }

    /**
     * @Assert\Callback
     */
    public function validateInput(ExecutionContextInterface $context): void
    {
        $this->category = $this->manager->getRepository(Category::class)->find($this->getCategoryId());
        $this->subcategory = $this->manager->getRepository(SubCategory::class)->find($this->getSubCategoryId());

        if (empty($this->subcategory)) {
            $context->buildViolation('category not found')
                ->atPath('categoryId')
                ->addViolation();
        }

        if (empty($this->category)) {
            $context->buildViolation('sub-category not found')
                ->atPath('subcategoryId')
                ->addViolation();
        }
    }
}
