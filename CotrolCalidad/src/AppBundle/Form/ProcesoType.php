<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProcesoType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('nombre', TextType::class,array(
                "attr" =>array("class" => "form-control") 
            ))
        ->add('version', TextType::class,array(
                "attr" =>array("class" => "form-control") 
            ))
        ->add('vigencia',TextType::class,array(
                "label" => "Vigencia:",
                "attr" =>array("class" => "form-control") 
            ))
        ->add('macroProceso', EntityType::class,array(
                "class" => "AppBundle:MacroProceso",
                "label" => "Macro Proceso:",
                "attr" =>array("class" => "form-control hidden")
            ));
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Proceso'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_proceso';
    }


}
