<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class NivelType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('nombre', textType::class,array(
                "attr" =>array("class" => "form-control") 
            ))

        ->add('valorMinimo', numberType::class,array(
                "attr" =>array("class" => "form-control") 
            ))
        ->add('valorMaximo', numberType::class,array(
                "attr" =>array("class" => "form-control") 
            ))
        ->add('color', textType::class,array(
                "attr" =>array("class" => "form-control my-colorpicker1") 
            ));
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Nivel'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_nivel';
    }


}
