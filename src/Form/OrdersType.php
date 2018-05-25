<?php

namespace App\Form;

use App\Entity\Orders;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class OrdersType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('ticket', ChoiceType::class, array(
                'choices' => array(
                    'journée' => 'journée',
                    'demi-journée' => 'demi-journée'
                )
            ))
            ->add('visit_day', DateType::class, array(
                'widget' => 'single_text',
                'format' => \IntlDateFormatter::SHORT,
                'label' => 'Jour de la visite',
                'attr' => array(
                    'data-provide' => 'datepicker',
                    'format' => \IntlDateFormatter::SHORT,
                    'data-date-autoclose' => true,
                    'data-date-start-date' => '0d',
                    'data-date-days-of-week-disabled' => '0,2',
                    'data-date-days-of-week-highlighted' => '0,2',
                    'data-date-today-highlight' => true,
                    'data-date-max-view-mode' => 1
                    ))
                )
            ->add('nb_ticket', ChoiceType::class,array('label' => 'Nombre de ticket',
                'choices' => array(
                    '1' => 1,
                    '2' => 2,
                    '3' => 3,
                    '4' => 4,
                    '5' => 5,
                    '6' => 6,
                    '7' => 7,
                    '8' => 8,
                    '9' => 9,
                    '10' => 10,
                )
            ))
            ->add('users', CollectionType::class, array(
                'entry_type' => UsersType::class,
                'entry_options' => array(
                    'label' => false
                    ),
                        'allow_add' => true,
                        'allow_delete' => true,
                        'by_reference' => false
                ))
            ->add('valider', SubmitType::class, array('label' => 'Valider'));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Orders::class
        ]);
    }
}
