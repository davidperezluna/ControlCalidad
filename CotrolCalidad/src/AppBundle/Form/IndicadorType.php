<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class IndicadorType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('codigo', NumberType::class,array(
                "attr" =>array("class" => "form-control")
            ))
        ->add('nombre', TextType::class,array(
                "attr" =>array("class" => "form-control")
            ))
        ->add('medida', TextType::class,array(
            'label'  => 'Unidad de medida',
                "attr" =>array("class" => "form-control")
            ))

        ->add('calculoTotal', ChoiceType::class, array(

            'choices'  => array(
                'ACUMULATIVA' => 'ACUMULATIVA',
                'PROMEDIO' => 'PROMEDIO',
            ),
             "attr" =>array("class" => "form-control")
        ))
        ->add('tipo', ChoiceType::class, array(
            'choices'  => array(
                'RESULTADO' => 'RESULTADO',
                'PRODUCTO' => 'PRODUCTO',
                'PROCESO' => 'PROCESO',
            ),
             "attr" =>array("class" => "form-control")
        ))
        ->add('tablero', ChoiceType::class, array(
            'choices'  => array(
                'SI' => 'SI',
                'NO' => 'NO',
            ),
             "attr" =>array("class" => "form-control")
        ))
        ->add('objetivo', TextareaType::class,array(
                "attr" =>array("class" => "form-control")
            ))
        ->add('pertinencia', TextType::class,array(
                "attr" =>array("class" => "form-control")
            ))
        ->add('unidadMedida', ChoiceType::class, array(
             'label'  => 'Formula',
            'choices'  => array(
                '(A/B)*100' => 'PORCENTAJE',
                'A-B' => 'NUMERO',
                '(A-B)/B' => 'INDICE',
                'A' => 'NOVEDAD',
                'FECHA_A - FECHA_B' => 'DIAS',
                '(FECHA_A - FECHA_B)/C' => 'DIAS AMPLIADO',
            ),
             "attr" =>array("class" => "form-control")

        ))
        ->add('metodolgia', TextType::class,array(
                "attr" =>array("class" => "form-control")
            ))
        ->add('periodicidad', ChoiceType::class, array(
            'choices'  => array(
                'MENSUAL' => 'MENSUAL',
                'BIMENSUAL' => 'BIMENSUAL',
                'TRIMESTRAL' => 'TRIMESTRAL',
                'SEMANAL' => 'SEMANAL',
                'ANUAL' => 'ANUAL',
            ),
             "attr" =>array("class" => "form-control")

        ))
        ->add('lineaBase', TextType::class,array(
                "attr" =>array("class" => "form-control")
            ))
        ->add('meta', TextType::class,array(
                "attr" =>array("class" => "form-control")
            ))

        ->add('porcentajeAcciones', NumberType::class,array(
                "attr" =>array("class" => "form-control")
            ))

        ->add('rango', EntityType::class, array(
            'class' => 'AppBundle:Rango',
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
            'data_class' => 'AppBundle\Entity\Indicador'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_indicador';
    }


}
