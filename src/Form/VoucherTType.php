<?php

namespace App\Form;

use App\Entity\VoucherType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VoucherTType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Name',
                'label_attr' => [
                    'class' => 'form-label text-black',
                ],
                'required' => true,
                'attr' => [
                    'placeholder' => 'Name of voucher type',
                    'class' => 'form-control',
                ],
                'row_attr' => [
                    'class' => 'col-12',
                ],
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Description',
                'label_attr' => [
                    'class' => 'form-label text-black',
                ],
                'required' => true,
                'attr' => [
                    'placeholder' => 'Description of voucher type',
                    'class' => 'form-control',
                ],
                'row_attr' => [
                    'class' => 'col-12',
                ],
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Submit',
                'attr' => [
                    'class' => 'btn btn-primary',
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => VoucherType::class,
            'attr' => [
                'class' => 'row g-3',
                'novalidate' => 'novalidate',
                'method' => 'POST',
            ],
        ]);
    }
}
