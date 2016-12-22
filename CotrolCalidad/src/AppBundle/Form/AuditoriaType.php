<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class AuditoriaType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('recomendaciones', TextareaType::class, array(
    'attr' => array('class' => 'form-control'),
))
        ->add('seguimiento', TextareaType::class, array(
    'attr' => array('class' => 'form-control'),
))
        ->add('informe', TextareaType::class, array(
    'attr' => array('class' => 'form-control'),
))
        ->add('concluciones', TextareaType::class, array(
    'attr' => array('class' => 'form-control'),
));
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Auditoria'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_auditoria';
    }


}
