<?php
/**
 * Created by PhpStorm.
 * User: samue
 * Date: 30/04/2018
 * Time: 09:33
 */

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver;

class UserTypeCollection extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder->add('users', CollectionType::class, array(

            'entry_type' => UserType::class,
            'entry_options' => array(
                'attr' => array('class' => 'email-box'),
            ),
        ));
    }
}