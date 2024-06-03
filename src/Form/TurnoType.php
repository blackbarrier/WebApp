<?php

namespace App\Form;

use App\Entity\EstadoTurno;
use App\Entity\Medico;
use App\Entity\Turno;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TurnoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('fecha', null, [
                'widget' => 'single_text',
            ])
            // ->add('fechaSolicitado', null, [
            //     'widget' => 'single_text',
            // ])
            // ->add('paciente')
            ->add('medico', EntityType::class, [
                'class' => Medico::class,
                'choice_label' => function (Medico $medico) {
                    return $medico->getNombre() . ' ' . $medico->getApellido();
                },
            ])
            ->add('descripcion')
            ->add('severidad')
            // ->add('estado', EntityType::class, [
            //     'class' => EstadoTurno::class,
            //     'choice_label' => 'descripcion',
            // ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Turno::class,
        ]);
    }
}
