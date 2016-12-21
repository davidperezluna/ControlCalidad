<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class CierreType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('estado', ChoiceType::class, array(
            'choices'  => array(
                'Sin Iniciar' => 'Sin Iniciar',
                'En Dessarollo' => 'En Dessarollo',
                'No Cumplido' => 'No Cumplido',
                'Cumplido' => 'Cumplido',
            ),
             "attr" =>array("class" => "form-control")
        ))
        ->add('usuario');
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Cierre'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_cierre';
    }


}
