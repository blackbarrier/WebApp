<?php

namespace App\Form;

use App\Entity\Rol;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('dni')
            ->add('password')
            ->add('borrado')
            ->add('Apellido')
            ->add('Nombre')
            ->add('email')
            ->add('matricula')
            ->add('especialidad')
            ->add('telefono')
            ->add('domicilio')
            ->add('edad')
            ->add('fnac', null, [
                'widget' => 'single_text',
            ])
            ->add('rol', EntityType::class, [
                'class' => Rol::class,
                'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
