<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ArchivoType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('version', TextType::class,array(
                "attr" =>array("class" => "form-control")
            ))
        ->add('descripcion', TextType::class,array(
                "attr" =>array("class" => "form-control")
            ))
        ->add('urlDocumento', FileType::class,array(
            "label" => "Documento Orijinal",
            'attr' =>array("class" =>"file file-5", "data-preview-file-type"=>"any", "data-upload-url"=>"#"),
            "data_class" => null
          )) 
        ->add('urlDocumentoPdf', FileType::class,array(
            "label" => "Documento",
            'attr' =>array("class" =>"file file-5", "data-preview-file-type"=>"any", "data-upload-url"=>"#"),
            "data_class" => null
          )) 

        // ->add('proceso', TextType::class,array(
        //         "attr" =>array("class" => " hidden")
        //     ))
        // ->add('procedimiento', TextType::class,array(
        //         "attr" =>array("class" => " hidden")
        //     ))
        ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Archivo'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_archivo';
    }


}
