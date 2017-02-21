<?php

namespace Tucompu\CmsBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ArticleTranslationsType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('article')
            ->add('language',null, array(
                'required' => true
            ))
            ->add('title')
            ->add('shortDescription')
            ->add('tags',null, array(
                'attr' => array(
                    'placeholder' => 'tema1, tema2'
                )
            ))
            ->add('content','textarea', array(
                    'required'=>true,
                    'attr' => array(
                        'class' => 'tinymce',
                        'data-theme' => 'advanced',
                    ),
                )
            )
            ->add('isActive',null,array(
                'required'=>false,
                'attr'=>array('class'=>'switch_widget'),
                'label'=>'Estado'
            ))

        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Tucompu\CmsBundle\Entity\ArticleTranslations'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'cmsbundle_articletranslations';
    }
}
