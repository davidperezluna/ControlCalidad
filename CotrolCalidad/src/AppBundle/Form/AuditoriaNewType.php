<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AuditoriaNewType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('tipoAuditoria', ChoiceType::class, array(
            'choices'  => array(
                'Interna' => 'Interna',
                'Externa' => 'Externa',
            ),
             "attr" =>array("class" => "form-control")
        ))
        ->add('objetivos', TextareaType::class,array(
                "attr" =>array("class" => "form-control") 
            ))
        ->add('alcance', TextareaType::class,array(
                "attr" =>array("class" => "form-control") 
            ))
        ->add('criterio', TextareaType::class,array(
                "attr" =>array("class" => "form-control") 
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
