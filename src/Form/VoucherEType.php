<?php

namespace App\Form;

use App\Entity\Voucher;
use App\Entity\VoucherType;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VoucherEType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'label' => 'Title',
                'label_attr' => [
                    'class' => 'form-label text-black',
                ],
                'required' => true,
                'attr' => [
                    'placeholder' => 'Title of voucher',
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
                    'placeholder' => 'Description of voucher',
                    'class' => 'form-control',
                ],
                'row_attr' => [
                    'class' => 'col-12',
                ],
            ])
            ->add('amount', NumberType::class, [
                'label' => 'Amount',
                'label_attr' => [
                    'class' => 'form-label text-black',
                ],
                'required' => true,
                'attr' => [
                    'placeholder' => 'Amount of voucher',
                    'class' => 'form-control',
                ],
                'row_attr' => [
                    'class' => 'col-12',
                ],
            ])
            ->add('permanent', CheckboxType::class, [
                'label' => 'Permanent',
                'label_attr' => [
                    'class' => 'form-label text-black',
                ],
                'required' => false,
                'attr' => [
                    'class' => 'form-check-input',
                ],
                'row_attr' => [
                    'class' => 'col-12',
                ],
            ])
            ->add('validFrom', DateType::class, [
                'label' => 'Valid from',
                'label_attr' => [
                    'class' => 'form-label text-black',
                ],
                'required' => false,
                'attr' => [
                    'class' => 'form-control',
                ],
                'row_attr' => [
                    'class' => 'col-12',
                ],
            ])
            ->add('validUntil', DateType::class, [
                'label' => 'Valid until',
                'label_attr' => [
                    'class' => 'form-label text-black',
                ],
                'required' => false,
                'attr' => [
                    'class' => 'form-control',
                ],
                'row_attr' => [
                    'class' => 'col-12',
                ],
            ])
            ->add('type', EntityType::class, [
                'class' => VoucherType::class,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('vt')
                        ->orderBy('vt.name', 'ASC');
                },
                'choice_label' => 'name',
                'label_attr' => [
                    'class' => 'form-label text-black',
                ],
                'row_attr' => [
                    'class' => 'col-md-12',
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
            'data_class' => Voucher::class,
            'attr' => [
                'class' => 'row g-3',
                'novalidate' => 'novalidate',
                'method' => 'POST',
            ],
        ]);
    }
}
