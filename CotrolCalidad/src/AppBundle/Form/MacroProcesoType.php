<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MacroProcesoType extends AbstractType
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
        ->add('sigla', TextType::class,array(
            "attr" =>array("class" => "form-control")
        ))
        ->add('dependencia', EntityType::class,array(
                "class" => "AppBundle:Dependencia",
                "label" => "Dependencia:",
                "attr" =>array("class" => "form-control")
            ))
        ->add('categoria', EntityType::class,array(
                "class" => "AppBundle:Categoria",
                "label" => "Categoria:",
                "attr" =>array("class" => "form-control")
            ));
    }
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\MacroProceso'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_macroproceso';
    }


}
