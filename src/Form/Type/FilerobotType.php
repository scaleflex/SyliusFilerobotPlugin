<?php

namespace Scaleflex\SyliusFilerobotPlugin\Form\Type;

use Sylius\Bundle\ResourceBundle\Form\Type\AbstractResourceType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

final class FilerobotType extends AbstractResourceType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('status', CheckboxType::class, [
                'label' => 'scaleflex_sylius_filerobot.form.status',
                'required' => false,
                'help' => 'scaleflex_sylius_filerobot.form.help.status',
            ])
            ->add('token', TextType::class, [
                'label' => 'scaleflex_sylius_filerobot.form.token',
                'required' => false,
                'help' => 'scaleflex_sylius_filerobot.form.help.token',
            ])
            ->add('templateId', TextType::class, [
                'label' => 'scaleflex_sylius_filerobot.form.template',
                'required' => false,
                'help' => 'scaleflex_sylius_filerobot.form.help.template',
            ])
            ->add('uploadDir', TextType::class, [
                'label' => 'scaleflex_sylius_filerobot.form.upload_dir',
                'required' => false,
                'help' => 'scaleflex_sylius_filerobot.form.help.upload_dir',
            ])
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix(): string
    {
        return 'scaleflex_sylius_filerobot_filerobot';
    }
}