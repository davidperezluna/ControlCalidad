<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class HallazgoType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('descripcion', TextareaType::class,array(
                "attr" =>array("class" => "form-control") 
            ))
        ->add('naturaleza', TextareaType::class,array(
                "attr" =>array("class" => "form-control") 
            ))
        ->add('tratamiento', TextareaType::class,array(
                "attr" =>array("class" => "form-control") 
            ))
        ->add('tipohallazgo', EntityType::class, array(
            'class' => 'AppBundle:TipoHallazgo',
            'choice_label' => 'nombre',
             "attr" =>array("class" => "form-control"),
        ));
    }
     
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Hallazgo'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_hallazgo';
    }


}
