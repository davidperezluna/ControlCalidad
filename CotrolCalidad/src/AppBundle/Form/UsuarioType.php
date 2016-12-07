<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;

class UsuarioType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('nombres', TextType::class,array(
                "label" => "Nombres:",
                "attr" =>array("class" => "form-control")
            ))

        ->add('apellidos', TextType::class,array(
                "label" => "Apellidos:",
                "attr" =>array("class" => "form-control")
            ))

        ->add('identificacion', NumberType::class,array(
                "label" => "identificacion:",
                "attr" =>array("class" => "form-control")
            ))
        ->add('direccion', TextType::class,array(
                "label" => "Apellidos:",
                "attr" =>array("class" => "form-control")
            ))
        ->add('telefono', TextType::class,array(
                "label" => "Telefono:",
                "attr" =>array("class" => "form-control")
            ))
        ->add('email', EmailType::class,array(
                "label" => "Correo:",
                "attr" =>array("class" => "form-control")
        ))
        ->add('role', ChoiceType::class,array(
                "label" => "Role:",
                "attr" =>array("class" => "form-control"),
                "choices"=> array(
                    "Administrador" => "ROLE_ADMIN",
                    "Usuario" => "ROLE_USER"
                ),
                "attr" =>array("class" => "form-control")
            ))
        
        ->add('password', RepeatedType::class, array(
            'type' => PasswordType::class,
            'invalid_message' => 'La Contraseña no conicide',
            'options' => array('attr' => array('class' => 'password-field form-control')),
            'required' => true,
            'first_options'  => array('label' => 'Contraseña'),
            'second_options' => array('label' => 'Confirmar Contraseña'),
             ));
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Usuario'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_usuario';
    }


}
