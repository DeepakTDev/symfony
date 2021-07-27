<?php

namespace App\Form\Type;

use App\DataObjects\Product;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class,[
                'property_path' => 'name',
            ])
            ->add('category_id', NumberType::class,[
                'property_path' => 'categoryId',
            ])
            ->add('sub_category_id', NumberType::class,[
                'property_path' => 'subcategoryId',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Product::class,
            'csrf_protection' => false
        ]);
    }

    public function getName()
    {
        return 'productType';
    }
}