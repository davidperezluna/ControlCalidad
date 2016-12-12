<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType; 
use Symfony\Component\OptionsResolver\OptionsResolver;

class DocumentoType extends AbstractType
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

        ->add('urlDocumento', FileType::class,array(
            "label" => "Documento",
            'attr' =>array("class" =>"file file-5", "data-preview-file-type"=>"any", "data-upload-url"=>"#"),
            "data_class" => null
          ))

        ->add('tipoDocumento', EntityType::class,array(
                "class" => "AppBundle:TipoDocumento",
                "label" => "tipo Documento:",
                "attr" =>array("class" => "form-control")
            ));
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Documento'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_documento';
    }


}
