<?php

namespace App\Form;

use App\Entity\EstadoTurno;
use App\Entity\Medico;
use App\Entity\Turno;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TurnoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('fecha'
            , DateType::class, [
                'widget' => 'single_text',
                'required' => true,
                "label" => "Fecha de turno", 
                "attr" => [
                    "class" => "form-control",
                ],
                // 'hours' => range(9, 17), // Permitir horas de 9 AM a 5 PM
                // 'minutes' => 0], // Solo permitir la selección de horas en punto
                // // 'html5' => false,
            ]
            )
            ->add('hora', ChoiceType::class, [
                'choices' => [
                    '9:00 AM' => '9:00',
                    '10:00 AM' => '10:00',
                    '11:00 AM' => '11:00',
                    '12:00 PM' => '12:00',
                    '13:00 PM' => '13:00',
                    '14:00 PM' => '14:00',
                    '15:00 PM' => '15:00',
                ],
                "attr" => [
                    "class" => "form-control",
                ],
                'mapped' => false,
                'multiple' => false,
            ])
            // ->add('fechaSolicitado', null, [
            //     'widget' => 'single_text',
            // ])
            // ->add('paciente')
            ->add('medico', EntityType::class, [
                'required' => true,
                'label' => "Seleccione un profesional",
                'class' => Medico::class,
                'choice_label' => function (Medico $medico) {
                    return $medico->getNombre() . ' ' . $medico->getApellido();
                },
                "attr" => [
                    "class" => "form-control",
                    'placeholder' => 'Seleccione un profesional',
                ],

            ])
            ->add('descripcion', TextType::class, [
                'required' => true,
                'label' => "Descripcion",
                "attr" => [
                    "class" => "form-control",
                    'placeholder' => 'Describa el motivo de su consulta',
                ],

            ])
                
            // ->add('severidad')
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
