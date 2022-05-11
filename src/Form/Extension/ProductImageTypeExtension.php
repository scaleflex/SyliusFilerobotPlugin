<?php

namespace Scaleflex\SyliusFilerobotPlugin\Form\Extension;

use Sylius\Bundle\CoreBundle\Form\Type\Product\ProductImageType;
use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

final class ProductImageTypeExtension extends AbstractTypeExtension
{

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        if (!$builder->has('path')) {
            $builder
                ->add('path', TextType::class, [
                    'label' => 'Path',
                ])
            ;
        }
    }

    public static function getExtendedTypes(): iterable
    {
        return [ProductImageType::class];
    }
}
