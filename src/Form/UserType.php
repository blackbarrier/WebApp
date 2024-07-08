<?php

namespace App\Form;

use App\Entity\Obrasocial;
use App\Entity\Rol;
use App\Entity\User;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType as TypeTextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Twig\Node\TextNode;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('dni', NumberType::class, [
                "required" => true,
                "label" => false,
                "attr" => [
                    "class" => "form-control",
                    'placeholder' => 'DNI',
                    "pattern" => "[0-9]{8}",
                    "title"     => "Ingrese 8 digitos para su DNI ",
                    "required" => true
                ],
            ])

            ->add('password', PasswordType::class, [
                "required" => true,
                "label" => false,
                "attr" => [
                    "class" => "form-control",
                    'placeholder' => 'Contraseña',
                ],  
            ])
            ->add('password2', PasswordType::class, [
                "mapped" => false,
                "required" => true,
                "label" => false,
                "attr" => [
                    "class" => "form-control",
                    'placeholder' => 'Contraseña',
                ],
            ])

            ->add('apellido', TextType::class, [
                "required" => true,
                "label" => "Apellido",
                "attr" => [
                    "class" => "form-control",
                    'placeholder' => 'Apellido',
                ],
            ] )         

            ->add('nombre', TextType::class, [
                "required" => true,
                "label" => "Nombre",
                "attr" => [
                    "class" => "form-control",
                    'placeholder' => 'Nombre',
                ],
            ])

            ->add('email', EmailType::class,[
                "required" => true,
                "label" => "Email",                
                "attr" => [
                    "class" => "form-control",
                    'placeholder' => 'Email',
                ],
            ])

            ->add('telefono', NumberType:: class,[
                "required" => true,
                "label" => "Teléfono", 
                "attr" => [
                    "class" => "form-control",
                    'placeholder' => 'Telefono',
                    "pattern" => "[0-9]",
                    "title"     => "Ingrese su DNI ",
                    "required" => true
                ],
            ])

            ->add('domicilio', TextType::class, [
                "required" => true,
                "label" => "Domicilio",
                "attr" => [
                    "class" => "form-control",
                    'placeholder' => 'Domicilio',
                ],
            ])
            ->add('fnac', DateType::class, [
                'widget' => 'single_text',
                'label' => 'Fecha de nacimiento',
                'label_attr' => [
                    'color' => 'blue'
                ],
                "attr" => [
                    "class" => "form-control",
                    // 'placeholder' => 'Fecha de nacimiento',
                ],
                // 'help' => 'Fecha de nacimiento',
            ])
            ->add('obrasocial', EntityType::class, [
                "required" => true,
                "label" => "Obra social",
                'class' => Obrasocial::class,
                'choice_label' => 'obraSocial',
                "attr" => [
                    "class" => "form-control",
                    'placeholder' => 'Fecha de nacimiento',
                ],
        
            ])

            // ->add('matricula')
            // ->add('especialidad')
            // ->add('rol', EntityType::class, [
                //     'class' => Rol::class,
                //     'choice_label' => 'id',
                // ])
            // ->add('borrado')

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
