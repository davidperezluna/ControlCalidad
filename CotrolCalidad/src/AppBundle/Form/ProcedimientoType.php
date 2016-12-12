<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
<<<<<<< HEAD
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
=======
>>>>>>> origin/master
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProcedimientoType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
<<<<<<< HEAD
        ->add('codigo', TextType::class,array(
                "attr" =>array("class" => "form-control") 
            ))
        ->add('nombre', TextType::class,array(
                "attr" =>array("class" => "form-control") 
            ))

        ->add('vigencia', TextType::class,array(
                "label" => "Vigencia:",
                "attr" =>array("class" => "form-control") 
            ))

        ->add('version', TextType::class,array(
                "attr" =>array("class" => "form-control") 
            ))
        ->add('proceso', EntityType::class,array(
                "class" => "AppBundle:Proceso",
                "label" => "Proceso:",
                "attr" =>array("class" => "form-control")
            )) 

        ->add('urlDocumento', FileType::class,array(
            "label" => "Documento Original",
            'attr' =>array("class" =>"file file-5", "data-preview-file-type"=>"any", "data-upload-url"=>"#"),
            "data_class" => null
          )) 
        ->add('urlDocumentoPdf', FileType::class,array(
            "label" => "Documento",
            'attr' =>array("class" =>"file file-5", "data-preview-file-type"=>"any", "data-upload-url"=>"#"),
            "data_class" => null
          ));
=======
        ->add('codigo')
        ->add('nombre')
        ->add('vigencia')
        ->add('version')
        ->add('proceso');
        
>>>>>>> origin/master
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Procedimiento'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_procedimiento';
    }


}
