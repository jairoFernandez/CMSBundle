<?php

namespace Tucompu\CmsBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class BannerImagesType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('banner',null,array(
                'attr'=>array(
                    'class' => 'form-control'
                )
            ))
            ->add('title',null,array(
                'attr'=>array(
                    'class' => 'form-control'
                )
            ))
            ->add('file', 'file', array(
                'required' => false,
                'label' => 'Image'
            ))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Tucompu\CmsBundle\Entity\BannerImages'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'cmsbundle_bannerimages';
    }
}
